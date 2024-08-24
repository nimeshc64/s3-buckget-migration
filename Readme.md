# S3 Bucket Migration Script

This PHP script migrates all content from one Amazon S3 bucket to another S3 bucket in different AWS accounts. It uses the AWS SDK for PHP and environment variables to securely configure the required credentials.

## Prerequisites

1. **PHP 7.2 or higher**
2. **Composer**: Dependency manager for PHP
3. **AWS SDK for PHP**: Installed via Composer
4. **vlucas/phpdotenv**: For managing environment variables

## Installation

1. **Clone the repository** (or download the script):

2. **Install Dependencies**:
   Use Composer to install the required packages:
   ```bash
   composer install
   ```

3. **Create a `.env` File**:
   In the root directory of the project, create a `.env` file with the following content:

   ```dotenv
   # Source S3 Bucket
   SOURCE_S3_BUCKET=source-bucket-name
   SOURCE_S3_REGION=source-region
   SOURCE_S3_KEY=source-access-key-id
   SOURCE_S3_SECRET=source-secret-access-key

   # Destination S3 Bucket
   DESTINATION_S3_BUCKET=destination-bucket-name
   DESTINATION_S3_REGION=destination-region
   DESTINATION_S3_KEY=destination-access-key-id
   DESTINATION_S3_SECRET=destination-secret-access-key
   ```

   Replace the placeholder values with your actual AWS credentials and bucket details.

## Usage

1. **Run the Script**:
   Execute the script in the terminal:

   ```bash
   php migrate.php
   ```

   The script will:
   - List all objects in the source S3 bucket.
   - Copy each object to the destination S3 bucket.

2. **Check the Output**:
   The script will output the keys of the objects being copied and confirm once the migration is completed.

## Important Notes

- **Permissions**: Ensure that the AWS credentials used have the necessary permissions to list objects from the source bucket and to copy them to the destination bucket.
- **Bucket Regions**: Make sure that the regions specified for the source and destination buckets are correct.
- **Large Datasets**: For larger datasets or specific requirements like handling versioned objects or large files, consider additional optimizations or parallel processing.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any improvements or fixes.

## Support

For any questions or issues, please open an issue on GitHub or contact the repository owner.