# Documents

## List uploads

```php
$uploads = $project->vault()->uploads()->index();
```

## Show a upload

```php
$upload = $project->vault()->upload()->show($id);
```

## Create a new upload

> See [attachments](https://github.com/coopbelvedere/laravel-basecamp-api/blob/master/docs/attachments.md)
before creating a new upload.

```php
$upload = $project->vault()->uploads()->store([
    'attachable_sgid' => $attachment->attachable_sgid,
    'description' => '<div><strong>Yum</strong></div>',
    'base_name' => 'yummy_pizza',
]);
```

## Update a upload

```php
$upload->update([
    'title' => 'New Hire Information',
    'content' => '<div><strong>Let\'s get started</strong></div>',
]);

// Or update with ID.
$project->vault()->uploads()->update($id, [...]);
```

## Delete a upload

```php
$upload->destroy();

// Or destroy with ID.
$project->vault()->uploads()->destroy($id);
```
