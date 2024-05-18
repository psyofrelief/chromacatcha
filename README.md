# ChromaCatcha

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![DaisyUI](https://img.shields.io/badge/daisyui-5A0EF8?style=for-the-badge&logo=daisyui&logoColor=white)
![Emacs](https://img.shields.io/badge/Emacs-%237F5AB6.svg?&style=for-the-badge&logo=gnu-emacs&logoColor=white)

Explore the live demo at [ChromaCatcha Demo](https://billowing-tokyo-80yqaltndrll.vapor-farm-f1.com/)

## About this project
The web application ChromaCatcha was developed using Tailwind CSS, PHP, and Laravel. By parsing its CSS files, it enables users to extract colors from a given URL. After that, users can view the retrieved colors in HEX or RGB formats. 

## Features
- Extract colors from a URL's CSS files
- View extracted colors in RGB or HEX format
- User-friendly interface

## Technologies Used
- **Laravel**: Laravel is a PHP web application development framework that is used in the project's construction.
- **Tailwind CSS**: The user interface is styled with Tailwind CSS, which prioritizes usefulness above design and allows for quick development.
- **PHP**: PHP is used to handle HTTP requests and perform server-side logic.
- **Emacs**: Emacs is a potent text editor that is used for writing and managing the project source code.

## Installation
To run this project locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/psyofrelief/chromacatcha.git
   ```
2. Navigate to the project directory:
   ```bash
   cd chromacatcher
   ```
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Set up your environment variables by copying the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
5. Generate an application key:
   ```bash
   php artisan key:generate
   ```
6. Start the development server:
   ```bash
   php artisan serve

   ```
6. Start the vite server:
   ```bash
   npm run watch
   ```
7. Open your browser and visit `http://localhost:8000` to view the application.

## Usage
1. Enter a URL into the input field on the homepage.
2. Click the "Extract" button to extract colors from the URL's CSS files.
3. View the extracted colors in RGB or HEX format.
4. Explore the vibrant color palettes and use them for your projects.

## Preview Images

### Home Page
![Home Page Preview](https://imgur.com/H2KUh5l.jpg)

### Colors Page
![Colors Page Preview](https://imgur.com/NnIt4fA.jpg)

## Credits
This project was created by Faried Idris. You can find more of my work on [GitHub](https://www.github.com/psyofrelief).

## License
This project is licensed under the [MIT License](LICENSE).
