# Message types

## List message types

```
$messageTypes = $project->messageTypes()->index();
```

### Show a message type

```
$messageType = $project->messageTypes()->show($id);
```

### Create a new message type

```
$messageType = $project->messageTypes()->store([
    'name' => 'Announcement',
    'icon' => '📢',
]);
```

### Update a message type

```
$messageType->update([
    'name': 'Quick Update',
    'icon': '📢'
]);

// Or update with ID.
$project->messageTypes()->update($id, [...]);
```

### Delete a message type

```
$messageType->destroy();

// Or destroy with ID.
$project->messageTypes()->destroy($id);
```
