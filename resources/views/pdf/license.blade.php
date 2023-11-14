<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>License</title>
    <style>
        * {
            font-family: DejaVu Sans !important;
        }

        ul {
            list-style: none;
            padding: 0;
        }
    </style>
</head>

<body>
    Licensee: {{ $license->user->name }}
    <br>
    Email: {{ $license->user->email }}
    <br>
    Date of Purchase: {{ $license->user->subscription_last->created_at }}
    <br>
    <br>
    This document certifies the purchase of the following license under the subscription package
    {{ $license->user->subscription_last->subscription_type->name }} as per your request dated
    {{ $license->user->subscription_last->created_at }}
    <ul>
        <li>
            <strong>- License Type:</strong> Commercial Use License
        </li>
        <li>
            <strong>- Track Title:</strong> {{ $license->licensesable->title }}
        </li>
        <li>
            <strong>- Track Author:</strong> {{ $license->licensesable?->artist?->artist_name }}
        </li>
        <li>
            <strong>- Track URL:</strong> {{ 'https://topaudio.store/music/' . $license->licensesable->id }}
        </li>
        <li>
            <strong>- Track ID:</strong> {{ $license->licensesable->id }}
        </li>
        <li>
            <strong>- Unique License Code:</strong> {{ $license->code }}
        </li>
    </ul>
    License Terms and Conditions:
    <br>
    Please refer to <a href="https://topaudio.store/pricing">https://topaudio.store/pricing</a> for detailed terms and
    conditions governing the use of this license.
    <br>
    <br>
    Customer Support:
    <br>
    For any inquiries related to this document or license, please contact TopAudio.Store Support via
    <a href="https://topaudio.store/contacts">https://topaudio.store/contacts</a>
    <br>
    <br>
    Note: This document serves as a license certificate and is not a tax receipt or invoice.
</body>

</html>
