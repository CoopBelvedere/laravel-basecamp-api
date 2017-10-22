# People

## List people

```
$people = Basecamp::people()->index();
```

## List people on a project

```
$people = Basecamp::people()->inProject($projectId);
```

## Update who can access a project

```
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

```
$people = Basecamp::people()->pingable();
```

## Show a person

```
$people = Basecamp::people()->show($id);
```

## Show the connected person profile

```
$profile = Basecamp::people()->profile();
```
