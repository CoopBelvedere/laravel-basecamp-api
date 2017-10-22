# People

## List people

```php
$people = Basecamp::people()->index();
```

## List people on a project

```php
$people = Basecamp::people()->inProject($projectId);
```

## Update who can access a project

```php
$access = Basecamp::people()->updateAccessToProject($projectId, [
    'grant' => [$userId],
    'revoke' => [],
    'create' => [
        'name' => 'Victor Cooper',
        'email_address' => 'email@example.dev',
        'title' => 'Prankster',
        'company_name' => 'Hancho Design',
    ],
]);
```

## List pingable people

```php
$people = Basecamp::people()->pingable();
```

## Show a person

```php
$people = Basecamp::people()->show($id);
```

## Show the connected person profile

```php
$profile = Basecamp::people()->profile();
```
