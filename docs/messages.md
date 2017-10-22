# Message

## List messages

```php
$messages = $project->messageBoard()->messages()->index();
```

### Show a message

```php
$message = $project->messageBoard()->messages()->show($id);
```

### Create a new message

```php
$message = $project->messageBoard()->messages()->store([
    'subject' => 'Kickoff',
    'status' => 'active',
    'content' => 'Welcome to Basecamp, everyone.',
    'category_id' => 1, // See message_types
]);
```

### Update a message

```php
$message->update([
    'subject' => 'Spin-down',
    'content' => 'Oops, we lost that client.',
    'category_id' => 1, // See message_types
]);

// Or update with ID.
$project->messageBoard()->messages()->update($id, [...]);
```

### Delete a message

```php
$message->destroy();

// Or destroy with ID.
$project->messageBoard()->messages()->destroy($id);
```
