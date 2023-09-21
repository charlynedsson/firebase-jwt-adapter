# Firebase JWT Adapter

WordPress pluging to encode Firebase signed JWT.

**Dependencies with ReactPress and WPAPI.**

## Install

1. Install plugin
2. From Firebase project console download service account JSON file
3. From WordPress Admin Dashboard select "Firebase JWT Adapter" settings
4. Copy and paste Firebase service account JSON file content

## Endpoint

```php
/**
 * If current user is logged-in, will return a JWT that can be used with Firebase services.
 */

[wp_root_url]/wp-json/fja/v1/getTokenWithCookie
```

## Customise

```php
/**
 * Use "fja_set_uid" filter hook to customise user's UID.
 */
add_filter("fja_set_uid", "prefix_custom_callback");

/**
 * Use "fja_set_custom_claims" filter hook to add custom claims.
 * @param  string  $user_id  The logged-in current user.
 */
add_filter("fja_set_custom_claims", "prefix_custom_callback");
```

## Contributing

Contributions are very welcome!
