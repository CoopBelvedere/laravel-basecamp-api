# Vaults

## Show a vault

```php
// The vault is returned with a project dock with enough
// information for most use cases.
$vault = Basecamp::projects()->show($projectId)->vault();
```

```php
// If you need to call the endpoint for more details:
$vault->show();

// Or
$vault = Basecamp::vaults($projectId)->show($id);
```
