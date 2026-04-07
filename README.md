# Mileena CRM Skeleton

Minimal CRM skeleton based on **Mileena** framework.

## Quick start

```bash
composer create-project andreyukdev/mileena-crm-skeleton new-crm
cd new-crm
composer require andreyukdev/mileena
```

### Customize namespace (IMPORTANT)
By default, the skeleton uses the Mileena\CrmSkeleton namespace.
If you want to rename it to your own (e.g., App), follow these steps after the project is created.

Manual rename (recommended if you don't plan to update the skeleton)
Rename the src/ folder to your desired structure (e.g., src/App)

Change the namespace declarations in all .php files inside src/

Update composer.json:

```json
"autoload": {
    "psr-4": {
      "App\\": "src/App/"
    }
}
```
Run composer dump-autoload

### ⚠️ Warning: After renaming the namespace, you will not be able to easily pull updates from the original skeleton via Git, because file paths and namespaces will no longer match.

Alternative (recommended if you want future updates)
Keep the original Mileena\CrmSkeleton namespace and create your own classes in a separate folder (e.g., src/App/). Your classes can extend or use the skeleton classes without breaking the ability to update.

```php
namespace App\Controller;

use Mileena\CrmSkeleton\Controller\BaseController;

class MyController extends BaseController { ... }
```

## What's inside
Basic directory structure (src/, config/, templates/)

Ready-to-use index.php with Mileena bootstrap

.env.example for environment configuration

PSR-4 autoloading ready

## Next steps
Copy .env.example to .env and adjust your database/redis settings

Start building your CRM

## Requirements
PHP 8.4 or higher

Composer

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.