# Comments

## List comments

```
$comment = $commentableResource->comments()->index();
```

## Show a comment

```
$comment = $commentableResource->comments()->show($id);
```

## Create a new comment

```
$comment = $commentableResource->comments()->store('Hello!');
```

## Update a comment

```
$comment->update('Bye!');

// Or update with ID.
$commentableResource->comments()->update($id, 'Bye!');
```

## Delete a comment

```
$comment->destroy();

// Or destroy with ID.
$commentableResource->comments()->destroy($id);
```
