# Comments

## List comments

```php
$comment = $commentableResource->comments()->index();
```

## Show a comment

```php
$comment = $commentableResource->comments()->show($id);
```

## Create a new comment

```php
$comment = $commentableResource->comments()->store('Hello!');
```

## Update a comment

```php
$comment->update('Bye!');

// Or update with ID.
$commentableResource->comments()->update($id, 'Bye!');
```

## Delete a comment

```php
$comment->destroy();

// Or destroy with ID.
$commentableResource->comments()->destroy($id);
```
