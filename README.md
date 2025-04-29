# FarmerPortal

FarmerPortal is a Laravel-based web application designed to connect farmers with buyers, provide agricultural resources, and streamline the process of managing farm-related activities.

## Features

- **Farmer Registration**: Farmers can create accounts and manage their profiles.
- **Product Listings**: Farmers can list their products for sale.
- **Buyer Portal**: Buyers can browse and purchase products.
- **Order Management**: Track and manage orders efficiently.
- **Resource Center**: Access agricultural tips, weather updates, and more.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/ANSH127/FarmerPortal.git
    cd FarmerPortal
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    ```

3. Set up the environment:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure your `.env` file with database and other settings.

5. Run migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```

6. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

- Access the application at `http://localhost:8000`.
- Register as a farmer or buyer to explore the features.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch:
    ```bash
    git checkout -b feature-name
    ```
3. Commit your changes:
    ```bash
    git commit -m "Add feature-name"
    ```
4. Push to your branch:
    ```bash
    git push origin feature-name
    ```
5. Open a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

For any inquiries, please contact [anshagrawal12348@gmail.com].