# Message

## List messages

```
$messages = $project->messageBoard()->messages()->index();
```

### Show a message

```
$message = $project->messageBoard()->messages()->show($id);
```

### Create a new message

```
$message = $project->messageBoard()->messages()->store([
    'subject' => 'Kickoff',
    'status' => 'active',
    'content' => 'Welcome to Basecamp, everyone.',
    'category_id' => 1, // See message_types
]);
```

### Update a message

```
$message->update([
    'subject' => 'Spin-down',
    'content' => 'Oops, we lost that client.',
    'category_id' => 1, // See message_types
]);

// Or update with ID.
$project->messageBoard()->messages()->update($id, [...]);
```

### Delete a message

```
$message->destroy();

// Or destroy with ID.
$project->messageBoard()->messages()->destroy($id);
```
