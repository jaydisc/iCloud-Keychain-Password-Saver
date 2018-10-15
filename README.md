# iCloud-Keychain-Password-Saver

A simple, one-file PHP website for storing arbitrary passwords in iCloud Keychain against a keyword.

## Why

iCloud Keychain seems limited to storing passwords for websites. So, if you want to store a password that isn't for a website, but you want to access this password on any of your iCloud devices, this gives you an easy-to-use solution that lets you save such a password, by saving it against a hostname which includes your chosen keyword, so you can easily look it up later via that keyword.

## Setup

You need to configure the DNS and Virtual Host config for a hostname of your choice, along with any subdomains beneath it (via wildcard), to resolve to the public_html folder in this repo. This chosen hostname should also be set as the value for the `$parent_domain` variable at the top of the PHP file. You will also want SSL enabled for this site. I used [Lets Encrypt](https://letsencrypt.org), via [acme.sh](https://github.com/Neilpang/acme.sh), to setup and maintain a free, wildcard, SSL certificate for my instance of this site.

## Use

When you first load the site at the parent domain, you will be asked to choose a keyword. Upon doing so, you will be redirected to [the-keyword-you-chose].your-hostname.com, which should just reload the same PHP file. This time, the keyword will be in the URL, and you can now store a password, and optionally a username, and these will be saved in iCloud Keychain with the current URL (which includes your keyword). Then, you can either store additional passwords for that hostname, or choose another keyword and repeat the process.

## Example

Let's say I want to store the password for my journal. I visit my instance of this site at passwords.practiceofcode.com. When I get there, I enter the keyword, "journal". I am then redirected to journal.passwords.practiceofcode.com. When I get there, I enter the password for my journal, and submit.

My password is now saved in iCloud keychain with the hostname, "journal.passwords.practiceofcode.com". On my iOS device, if I search for "journal" or ask Siri what my password for "journal" is, this password comes up in the search results.