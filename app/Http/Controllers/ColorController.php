<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\HttpClientException;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function extractColors(Request $request)
    {
        try {
            // PARSE THE HTMLCONTENT AND THE CSSCONTENT FOR COLORS

            $url = $request->input('url');
            $validator = Validator::make($request->all(), [
                'url' => 'required|url'
            ]);

            // If there's an error with the url
            if ($validator->fails()) {
                $errorMessage = $validator->errors()->first('url');

                Session::forget('colors');
                return redirect('/')->with(
                    'errorMessage', $errorMessage
                );
            }


            $response = Http::get($url);
            $htmlContent = $response->body();
            $client = new Client();
            $crawler = new Crawler($htmlContent);

            // Crawl css files from URL
            $cssFiles = $crawler->filter('link[rel="stylesheet"]')->extract(['href']);

             $allColors = [];

             // Loop through each CSS file
             foreach ($cssFiles as $cssFile) {
                 $cssUrl = (preg_match('/^https?:\/\//', $cssFile)) ? $cssFile : $url . $cssFile;
                 $response = $client->get($cssUrl);
                 $cssContent = $response->getBody()->getContents();

                 // Extract colors from the current CSS file
                 preg_match_all('/(?<=color:)#\w{3,6}|rgba\(\s*(?:\d{1,3}(?:,\s*\d{1,3})?(?:,\s*\d{1,3})?(?:,\s*(?:0?\.?\d+|\.[0-9]+))?\))|rgb\(\s*(?:\d{1,3}(?:,\s*\d{1,3})?(?:,\s*\d{1,3})?(?:,\s*(?:0?\.?\d+|\.[0-9]+))?\))|hsla\(\s*(?:\d{1,3}(?:,\s*\d{1,3})?(?:,\s*\d{1,3})?(?:,\s*(?:0?\.?\d+|\.[0-9]+))?\))|hsl\(\s*(?:\d{1,3}(?:,\s*\d{1,3})?(?:,\s*\d{1,3})?(?:,\s*(?:0?\.?\d+|\.[0-9]+))?\))/', $cssContent, $cssFileMatches);
                 $allColors = array_merge($allColors, $cssFileMatches[0]);
             }

             // Extract colors from HTML content
             preg_match_all('/(?<=color:)#\w{3,6}|rgba\(\s*(?:\d{1,3}(?:,\s*\d{1,3})?(?:,\s*\d{1,3})?(?:,\s*(?:0?\.?\d+|\.[0-9]+))?\))|rgb\(\s*(?:\d{1,3}(?:,\s*\d{1,3})?(?:,\s*\d{1,3})?(?:,\s*(?:0?\.?\d+|\.[0-9]+))?\))|hsla\(\s*(?:\d{1,3}(?:,\s*\d{1,3})?(?:,\s*\d{1,3})?(?:,\s*(?:0?\.?\d+|\.[0-9]+))?\))|hsl\(\s*(?:\d{1,3}(?:,\s*\d{1,3})?(?:,\s*\d{1,3})?(?:,\s*(?:0?\.?\d+|\.[0-9]+))?\))/', $htmlContent, $htmlFileMatches);

             $allColors = array_merge($allColors, $htmlFileMatches[0]);
             $colors = array_unique($allColors);


             session(['url' => $url]);
             session(['colors' => $colors]);

            return view('colors', compact('colors'));
        } catch (HttpClientException $e) {
            // If there's a HTTP error
            $errorMessage = 'Failed to fetch content: URL non-existent';
            Session::forget('colors');
            return redirect('/')->with(
                    'errorMessage', $errorMessage
                );
        } catch (\Exception $e) {
            // If there's an unexpected error
            $errorMessage = 'An unexpected error occurred';
            Session::forget('colors');
            return redirect('/')->with(
                    'errorMessage', $errorMessage
                );

        }
    }
}
