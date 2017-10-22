# Attachments

## Create a new attachment

```php
$name = 'pizza.png';
$file = '/path/to/my/file.png';
$attachment = Basecamp::attachments()->store($name, $file);
```

## Attachment in rich text

To include a new attachment or a mention in a rich text field, you can use
the `basecamp_attachment` helper function, it takes the sgid and a caption as
parameters and creates a `<bc-attachment>` tag. Example usage:

```php
    $attachmentTag = basecamp_attachment($attachment->attachable_sgid, 'Here');

    $project = Basecamp::projects()->show($id);

    $project->messageBoard()->messages()->store([
        'subject' => 'Here!',
        'content' => 'Right here: ' . $attachmentTag,
    ]);
```
