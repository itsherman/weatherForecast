# 5-Day Weather Forecast Application

A simple web and console application that displays a 5-day weather forecast for a given city.
The forecast includes average, maximum and minimum temperatures.
The web application allows the user to choose from Brisbane, the Gold Coast or the Sunshine Coast.

## Components
- Laravel: backend and requests from API
- Vue: frontend
- Intertia.js: links Laravel backend with Vue frontend
- Tailwind CSS: handles CSS styling

## Installation
1. Clone the repo.
2. Run 'composer install' to install php dependencies.
3. Run 'npm install' to install frontend dependencies.
4. Generate an API key at WeatherBit API and edit your .env to include it by adding 'WEATHER_API_KEY=your_api_key_here'.
5. Run migrations if needed using 'php artisan migrate'.
6. Clear cached configs or routes by running 'php artisan cache:clear config:clear route:clear view:clear'.
7. Run 'npm run dev' to build frontend.
8. In a separate terminal run 'php artisan serve' to start the local server.
9. Access the app at 'http://localhost:8000'.

## Usage
- The web app can be used by selecting one of the 3 given cities in the dropdown menu. A table will appear with that cities 5-day forecast.
- The console app can be used by running 'php artisan weatherForecast {city}'.
    - Example usage to display all 3 cities: 'php artisan weatherForecast Brisbane,GoldCoast,SunshineCoast'.

## Notes
- As requested, city selection uses a dropdown menu, which limits the user to 3 pre-defined cities. This simplifies the frontend requirements and allows us to avoid implementing dynamic search or auto-complete which would otherwise be useful.
- The backend and API are setup in a way that would allow additions like these to be made relatively easily though.
- Basic error handling for the UI construction, failed API fetch requests or invalid city names.
- The app assumes that the WeatherBit API service is accessible and accurate for all of its data.