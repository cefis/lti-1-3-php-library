<?php
namespace IMSGlobal\LTI;

class Cookie {
    public function get_cookie($name) {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
        // Look for backup cookie if same site is not supported by the user's browser.
        if (isset($_COOKIE["LEGACY_" . $name])) {
            return $_COOKIE["LEGACY_" . $name];
        }
        return false;
    }

    public function set_cookie($name, $value, $exp = 3600) {
        setcookie($name, $value, time() + $exp, '/; samesite=none', '', true);

        // Set a second fallback cookie in the event that "SameSite" is not supported
        setcookie("LEGACY_" . $name, $value, time() + $exp);
        return $this;
    }
}
?>
