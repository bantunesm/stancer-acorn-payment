# Stancer-Acorn-Payment

A Laravel package for integrating Stancer payments in a Roots Radicle (Acorn) environment.

## Installation

1. Add the package via Composer:

   ```bash
   composer require bantunes/stancer-acorn-payment
   ```

2. Publish the configuration file:

   ```bash
   php artisan vendor:publish --tag=config
   ```

## Configuration

Set the following environment variables in your `.env` file:

```
STANCER_API_KEY=your-stancer-api-key
STANCER_API_ENDPOINT=https://api.stancer.com
```

This ensures that the Stancer SDK is correctly initialized with your API credentials.

## Usage

The package provides a default route for handling payments. To test the functionality:

1. Send a POST request to the `/payment` endpoint with the following body:

   ```json
   {
       "card_number": "4242424242424242",
       "expiry_date": "12/24",
       "cvc": "123"
   }
   ```

2. Replace the card details with valid test credentials provided by Stancer.

3. The payment response will include the status and a unique `payment_id`:

   ```json
   {
       "status": "success",
       "payment_id": "paym_twqlZCFrfkUE69pRKKYByZct"
   }
   ```

## Customization

### Service Provider

The `StancerServiceProvider` automatically initializes the Stancer SDK using the values from your `.env` file. You can customize the behavior by modifying the `src/Config/stancer.php` file.

### Payment Controller

The `PaymentController` includes a `createPayment` method that handles payments using the Stancer SDK. You can extend it based on your application needs.
