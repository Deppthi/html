<?php
// Define the regular expressions for email addresses and phone numbers
$emailRegex = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';
$phoneRegex = '/\b\d{3}[-.]?\d{3}[-.]?\d{4}\b/';

// Read content from the text file
$textContent = file_get_contents('input.txt');

// Perform pattern matching to extract email addresses
preg_match_all($emailRegex, $textContent, $emailMatches);
$emailAddresses = $emailMatches[0];

// Perform pattern matching to extract phone numbers
preg_match_all($phoneRegex, $textContent, $phoneMatches);	
$phoneNumbers = $phoneMatches[0];

// Create XML document
$xml = new SimpleXMLElement('<data></data>');

// Add email addresses to XML
$emailNode = $xml->addChild('email_addresses');
foreach ($emailAddresses as $email) {
    $emailNode->addChild('email', $email);
}

// Add phone numbers to XML
$phoneNode = $xml->addChild('phone_numbers');
foreach ($phoneNumbers as $phone) {
    $phoneNode->addChild('phone', $phone);
}

// Save XML to file
$xml->asXML('output.xml');

echo 'Extraction completed. Results saved in output.xml';
?>