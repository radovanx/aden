<?php


//include_once 'includes/google-api-php-client-master/src/Google/Auth/AssertionCredentials.php';

$client = new Google_Client();
$client->setApplicationName('Hello Analytics API Sample');

// Visit https://console.developers.google.com/ to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId('826064936984-hpesp470bq2b8n2hatfgdl54m60rheev.apps.googleusercontent.com');
$client->setClientSecret('PC0h1pjtfe5KDUFqievqsZMe');
$client->setRedirectUri('http://www.immoneda.com/wp-admin/admin.php?page=user_stat');
$client->setDeveloperKey('AIzaSyAIM03j2bQnUAbBYucuF0rfpD7VlwSTOEQ');
$client->setScopes(array('https://www.googleapis.com/auth/analytics.readonly'));


$service = new Google_Service_Urlshortener($client);

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

// Magic. Returns objects from the Analytics Service instead of associative arrays.
//$client->setUseObjects(true);

?>


<div class="wrap">
    <div id="poststuff">
        <h2><?php _e('User stat', $this->plugin_slug) ?></h2>

        <button id="authButton">Loading...</button>
        <div id="dataControls" style="display:none">
            <p>
                For this user, retrieve the first 50 accounts with view (profile) ID and table ID
                <button id="getAccount">Get Account Data</button>
            </p>
            <p>
                For this view (profile), show user type and entrance/exit graphs:
                <input type="text" id="tableId"/> (insert Table ID)
                <button id="getData">Get Report Data</button>
            </p>
        </div>
        <table>
            <tr>
                <td><div id="usersDiv"></div></td>
                <td><div id="entrancesDiv"></div></td>
            </tr>
        </table>
        <img src="<?php echo $this->url ?>/assets/img/dummy.gif" style="display:none" alt="required for Google Data"/>
        
    </div>
</div>