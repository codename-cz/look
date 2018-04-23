Look - Work in progress
=======================

Single file simple website check.

Setup
-----

- Create Pushover account and app (https://pushover.net)
- Set ENV variables (system-wide or before script)
  - `LOOK_PUSHOVER_USER`
  - `LOOK_PUSHOVER_TOKEN`

* Certs for curl need to be set up in php.ini.
* PHP curl extension is required.


Usage
-----

`[interpreter] look.php (url) (regex)`

`php.exe look.php http://www.example.org/ "Example"`

Todo
----

- [ ] Mute repeated warnings.
- [ ] Make regex optional
- [ ] Enable simple certificate expiration check