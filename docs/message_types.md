# Message types

## List message types

```php
$messageTypes = $project->messageTypes()->index();
```

### Show a message type

```php
$messageType = $project->messageTypes()->show($id);
```

### Create a new message type

```php
$messageType = $project->messageTypes()->store([
    'name' => 'Announcement',
    'icon' => '📢',
]);
```

### Update a message type

```php
$messageType->update([
    'name': 'Quick Update',
    'icon': '📢'
]);

// Or update with ID.
$project->messageTypes()->update($id, [...]);
```

### Delete a message type

```php
$messageType->destroy();

// Or destroy with ID.
$project->messageTypes()->destroy($id);
```
