<?php
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined('MEDIAWIKI') ) {
	exit;
}

if (!defined('STDERR')) {
	define('STDERR', fopen('php://stderr', 'w'));
}

if (!isset($maintClass) || (isset($maintClass) && $maintClass !== 'PHPUnitMaintClass')) {
	$wgMWLoggerDefaultSpi = [
		'class' => \MediaWiki\Logger\ConsoleSpi::class,
	];
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = $_ENV["WG_SITENAME"];
$wgMetaNamespace = $_ENV["WG_METANAMESPACE"];

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "/w";
$wgUsePathInfo = true;

$actions = array('edit', 'watch', 'unwatch', 'delete','revert', 'rollback',
  'protect', 'unprotect', 'markpatrolled', 'render', 'submit', 'history', 'purge', 'info');

foreach ( $actions as $action ) {
  $wgActionPaths[$action] = "/wiki/$action/$1";
}
$wgActionPaths['view'] = "/wiki/$1";
$wgArticlePath = $wgActionPaths['view'];

## The protocol and server name to use in fully-qualified URLs
$wgServer = "//" . $_SERVER["SERVER_NAME"];
$wgCanonicalServer = "https://" . $_ENV["BIND_URL"];

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgScriptPath/images/c/c9/Logo.png";
$wgLogoHD["2x"] = "$wgScriptPath/images/b/b9/Logo_2x.png";
$wgFavicon = "$wgScriptPath/images/2/26/Favicon.png";
$wgAppleTouchIcon = "$wgScriptPath/images/a/ab/Apple_touch_icon.png";

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = $_ENV["WG_EMERGENCYCONTACT"];
$wgPasswordSender = $_ENV["WG_PASSWORDSENDER"];

$wgSMTP = [
    'host' => $_ENV["WG_SMTP_HOST"],
    'IDHost' => $_ENV["WG_SMTP_IDHOST"],
    'localhost' => $_ENV["WG_SMTP_LOCALHOST"],
    'port' => (int)$_ENV["WG_SMTP_PORT"],
    'username' => $_ENV["WG_SMTP_USERNAME"],
    'password' => $_ENV["WG_SMTP_PASSWORD"],
    'auth' => $_ENV["WG_SMTP_AUTH"] ? true : false
];

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = "db";
$wgDBname = "wiki";
$wgDBuser = $_ENV["MYSQL_USER"];
$wgDBpassword = $_ENV["MYSQL_PASSWORD"];

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;

# Allowed File Extensions
$wgFileExtensions = array(
	'png', 'gif', 'jpg', 'jpeg', 'ico',
	'pdf',
	'key', 'pages', 'numbers',
	'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx',
	'mp4', 'mov', 'm4v',
	'psd', 'ai',
	'webarchive' // especially for wiki site archiving
);

$wgTrustedMediaFormats[] = 'video/quicktime';

$wgUploadSizeWarning = 128*1024*1024;
$wgMaxUploadSize = 2*1024*1024*1024;

$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = true;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publicly accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "ko";

$wgSecretKey = $_ENV["WG_SECRETKEY"];

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = $_ENV["WG_UPGRADEKEY"];

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-nc-sa/4.0/";
$wgRightsText = "크리에이티브 커먼즈 저작자표시-비영리-동일조건변경허락";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by-nc-sa.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# Set default timezone
$wgLocaltimezone = "Asia/Seoul";

# Create a namespace 'Official'
define("NS_OFFICIAL", 100);
define("NS_OFFICIAL_TALK", 101);

$wgExtraNamespaces =
    array(NS_OFFICIAL => "학부총학생회",
          NS_OFFICIAL_TALK => "학부총학생회토론",
    );

$wgNamespaceAliases['오피셜'] = NS_OFFICIAL;
$wgNamespaceAliases['Official'] = NS_OFFICIAL;
$wgNamespaceAliases['학부총'] = NS_OFFICIAL;

$wgNamespaceAliases['오피셜토론'] = NS_OFFICIAL_TALK;
$wgNamespaceAliases['Official_talk'] = NS_OFFICIAL_TALK;

$wgNamespacesWithSubpages[NS_OFFICIAL] = true;
$wgNamespacesWithSubpages[NS_CATEGORY] = true;
$wgNamespacesWithSubpages[NS_TEMPLATE] = true;

$wgNamespacesToBeSearchedDefault[NS_OFFICIAL] = true;

$wgRestrictDisplayTitle = false;

$wgNamespacesWithSubpages[NS_MAIN] = true;
$wgNamespacesWithSubpages[NS_PROJECT] = true;
$wgNamespacesWithSubpages[NS_MEDIAWIKI] = true;
$wgNamespacesWithSubpages[NS_TEMPLATE] = true;

# The following permissions were set based on your choice in the installer
$wgNamespaceProtection[NS_PROJECT] = ['editproject'];

$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['read'] = false;
$wgGroupPermissions['sysop']['editproject'] = true;

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";
wfLoadSkin('Vector');
$wgVectorResponsive = true;
$wgVectorUseIconWatch = true;
wfLoadSkin('MinervaNeue');

# End of automatically generated settings.
# Add more configuration options below.

# Extensions
wfLoadExtension('BetaFeatures');
wfLoadExtension('CategoryTree');
wfLoadExtension('Cite');
wfLoadExtension('CollapsibleVector');
wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/ReCaptchaNoCaptcha' ]);
$wgCaptchaClass = 'ReCaptchaNoCaptcha';
$wgReCaptchaSiteKey = $_ENV["RECAPTCHASITEKEY"];
$wgReCaptchaSecretKey = $_ENV["RECAPTCHASECRETKEY"];
wfLoadExtension('CheckUser');
$wgGroupPermissions['sysop']['checkuser'] = true;
$wgGroupPermissions['user']['checkuser-log'] = true;
wfLoadExtension('CiteThisPage');
wfLoadExtension('CodeEditor');
$wgDefaultUserOptions['usebetatoolbar'] = 1; // user option provided by WikiEditor extension
wfLoadExtension('Disambiguator');
wfLoadExtension('Echo');
wfLoadExtension('EmbedVideo');
wfLoadExtension('EventLogging');
wfLoadExtension('Flow');
$wgContentHnadlerUseDB = true;
$wgFlowContentFormat = 'html';
$wgGroupPermissions['sysop']['flow-create-board'] = true;
$wgGroupPermissions['sysop']['flow-suppress'] = true;
$wgNamespaceContentModels[NS_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_USER_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_PROJECT_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_OFFICIAL_TALK] = 'flow-board';
wfLoadExtension('Gadgets');
wfLoadExtension('GuidedTour');
wfLoadExtension('Graph');
// wfLoadExtension('HSTS');
// $wgHSTSBetaFeature = true;
// $wgHSTSforanons = false;
// $wgHSTSForUsers = false;
// $wgHSTSIncludeSubdomains = false;
// $wgHSTSMaxAge = 30*24*60*60;
// $wgDefaultUserOptions['hsts'] = 1;
wfLoadExtension('ImageMap');
wfLoadExtension('InputBox');
wfLoadExtension('Interwiki');
$wgGroupPermissions['sysop']['interwiki'] = true;
wfLoadExtension('InviteSignup');
$wgGroupPermissions['bureaucrat']['invitesignup'] = true;
wfLoadExtension('JsonConfig');
// wfLoadExtension('Kartographer');
// wfLoadExtension('LocalisationUpdate');
// $wgLocalisationUpdateDirectory = "$IP/cache";
wfLoadExtension('Lockdown');
wfLoadExtension('LoginNotify');
wfLoadExtension('MassMessage');
wfLoadExtension('Math');
wfLoadExtension('MultimediaViewer');
wfLoadExtension('MobileFrontend');
$wgMFDefaultSkinClass = 'SkinMinerva';
wfLoadExtension('Nuke');
wfLoadExtension('OATHAuth');
$wgGroupPermissions['user']['oathauth-enable'] = true;
wfLoadExtension('PageImages');
wfLoadExtension('ParserFunctions');
$wgPFEnableStringFunctions = true;
wfLoadExtension('PageImages'); // Popups Extension Dependency
wfLoadExtension('PdfHandler');
wfLoadExtension('Poem');
wfLoadExtension('Popups');
$wgPopupsOptInDefaultState = '1';
wfLoadExtension('RevisionSlider');
wfLoadExtension('Renameuser');
wfLoadExtension('ReplaceText');
wfLoadExtension('SandboxLink');
wfLoadExtension('SecurePoll');
$wgGroupPermissions['bureaucrat']['securepoll-create-poll'] = true;
wfLoadExtension('Scribunto');
$wgScribuntoDefaultEngine = 'luastandalone';
wfLoadExtension('SiteMetrics');
wfLoadExtension('SpamBlacklist');
wfLoadExtension('SyntaxHighlight_GeSHi');
wfLoadExtension('TemplateData');
wfLoadExtension('TemplateStyles');
wfLoadExtension('TemplateWizard');
wfLoadExtension('Thanks');
wfLoadExtension('TextExtracts'); // Popups Extension Dependency
wfLoadExtension('TitleBlacklist');
wfLoadExtension('TwoColConflict');
wfLoadExtension('WikiEditor');

# VisualEditor Settings
wfLoadExtension('VisualEditor');
// Enable by default for everybody
$wgDefaultUserOptions['visualeditor-enable'] = 1;

// Optional: Set VisualEditor as the default for anonymous users
// otherwise they will have to switch to VE
$wgDefaultUserOptions['visualeditor-editor'] = "visualeditor";

// Don't allow users to disable it
// $wgHiddenPrefs[] = 'visualeditor-enable';

$wgVisualEditorAutoAccountEnable = true; // Whether to enable VisualEditor for every new account.

// $wgVisualEditorEnableTocWidget = true;

$wgDefaultUserOptions['visualeditor-enable-experimental'] = 1;

$wgVisualEditorEnableWikitext = true;
$wgDefaultUserOptions['visualeditor-newwikitext'] = 1;

$wgVisualEditorUseSingleEditTab = true;
$wgDefaultUserOptions['visualeditor-editor'] = "visualeditor";
$wgVisualEditorEnableDiffPage = true;

$wgVirtualRestConfig['modules']['parsoid'] = array(
    'url' => 'http://parsoid:8000',
    'domain' => 'wiki',
);
$wgSessionsInObjectCache = true;
$wgVirtualRestConfig['modules']['parsoid']['forwardCookies'] = true;

$wgVisualEditorAvailableNamespaces = [
	NS_PROJECT => true,
	NS_PROJECT_TALK => true,
	NS_MEDIAWIKI => true,
	NS_MEDIAWIKI_TALK => true,
	NS_TEMPLATE => true,
	NS_TEMPLATE_TALK => true,
	NS_HELP => true,
	NS_HELP_TALK => true,
	NS_OFFICIAL => true,
	NS_OFFICIAL_TALK => true
];

# limit Official namespace edit to sysop.
# see mediawiki.org/wiki/Manual:$wgNamespaceProtection
# and mediawiki.org/wiki/Manual:Using_custom_namespaces
$wgNamespaceProtection[NS_OFFICIAL]      = array('official-edit');
$wgNamespaceProtection[NS_MEDIAWIKI]     = array('mediawiki-edit');
$wgNamespaceProtection[NS_MEDIAWIKI_TALK]= array('mediawiki-talk-edit');
$wgNamespaceProtection[NS_PROJECT]       = array('project-edit');

$wgGroupPermissions['sysop']['official-edit'] = false; // sysop can edit pages in the Official namespace
$wgGroupPermissions['sysop']['mediawiki-edit'] = true; // sysop can edit pages in the MediaWiki namespace
$wgGroupPermissions['sysop']['mediawiki-talk-edit'] = true; // sysop can edit pages in the MediaWiki_talk namespace
$wgGroupPermissions['sysop']['project-edit'] = true;

## Custom user group Officer
$wgGroupPermissions['Officer'] = array(
    'official-edit' => true,
    'apihighlimits' => true,
    'autoconfirmed' => true,
    'suppressredirect' => true,
    'noratelimit' => true,
    'editsemiprotected' => true,
    'editmyprivateinfo' => true,
    'skipcaptcha' => true,
);

$wgGroupPermissions['bureaucrat']['deletelogentry'] = true;
$wgGroupPermissions['bureaucrat']['deleterevision'] = true;
$wgGroupPermissions['bureaucrat']['hideuser'] = true;
$wgGroupPermissions['bureaucrat']['suppressrevision'] = true;
$wgGroupPermissions['bureaucrat']['suppressionlog'] = true;
$wgGroupPermissions['bureaucrat']['viewsuppressed'] = true;


$wgShowExceptionDetails = true;
$wgShowDBErrorBacktrace = true;
