<?php
require '../../src/PKPass.php';
$pass = new PKPass\PKPass();
$pass->setCertificate('Certificates.p12');
// 2. Set the path to your Pass Certificate (.p12 file)
$pass->setCertificatePassword('usc');
// 2. Set password for certificate
$pass->setWWDRcertPath('AppleWWDRCA.pem');
// 3. Set the path to your WWDR Intermediate certificate (.pem file)
// Top-Level Keys <a class="vglnk" href="http://developer.apple.com/library/ios/#documentation/userexperience/Reference/PassKit_Bundle/Chapters/TopLevel.html" rel="nofollow"><span>http</span><span>://</span><span>developer</span><span>.</span><span>apple</span><span>.</span><span>com</span><span>/</span><span>library</span><span>/</span><span>ios</span><span>/#</span><span>documentation</span><span>/</span><span>userexperience</span><span>/</span><span>Reference</span><span>/</span><span>PassKit</span><span>_</span><span>Bundle</span><span>/</span><span>Chapters</span><span>/</span><span>TopLevel</span><span>.</span><span>html</span></a>
$standardKeys = array('description' => 'Demo pass', 'formatVersion' => 1, 'organizationName' => 'The App Company', 'passTypeIdentifier' => 'pass.com.universityofsouthcalifornia.USC', 'serialNumber' => '123456', 'teamIdentifier' => '5NT5R8D6K7');
$associatedAppKeys = array();
$relevanceKeys = array();
$styleKeys = array('boardingPass' => array('primaryFields' => array(array('key' => 'origin', 'label' => 'San Francisco', 'value' => 'SFO'), array('key' => 'destination', 'label' => 'London', 'value' => 'LHR')), 'secondaryFields' => array(array('key' => 'gate', 'label' => 'Gate', 'value' => 'F12'), array('key' => 'date', 'label' => 'Departure date', 'value' => '07/11/2012 10:22')), 'backFields' => array(array('key' => 'passenger-name', 'label' => 'Passenger', 'value' => 'John Appleseed')), 'transitType' => 'PKTransitTypeAir'));
$visualAppearanceKeys = array('barcode' => array('format' => 'PKBarcodeFormatQR', 'message' => 'Flight-GateF12-ID6643679AH7B', 'messageEncoding' => 'iso-8859-1'), 'backgroundColor' => 'rgb(107,156,196)', 'logoText' => 'Flight info');
$webServiceKeys = array();
// Merge all pass data and set JSON for $pass object
$passData = array_merge($standardKeys, $associatedAppKeys, $relevanceKeys, $styleKeys, $visualAppearanceKeys, $webServiceKeys);
$pass->setJSON(json_encode($passData));
// Add files to the PKPass package
$pass->addFile('icon.png');
$pass->addFile('icon@2x.png');
$pass->addFile('logo.png');
if (!$pass->create(true)) {
    // Create and output the PKPass
    echo 'Error: ' . $pass->getError();
}
?>
