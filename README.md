**Seedorder**

A very simple system for ordering seed
This was made specifically for the member seed exchange in STA (Sällskapet Trädgårdsamatörerna), 
but might easily be configured/modified for other similar associations.

Nerdy garden amateurs supply seeds every year. These are handled and distributed by volonteer members. 
Each year, a seed list is prepared (not covered by this system), as well as a secondary left-over list.
Each listed seed has a number.

This system consists of a simple ordering form in which members can input their membership and address
data, and a set of seed numbers (seed order). No login is required.

When the member submits the seed order, it is saved in a file (one per day with orders from that day 
appended sequentially). The files reside in a folder immediately outside of webroot. The member is 
presented with a confirmation web page, as well as a confirmation email.

The downstream handling of the seedorder files is outside the scope of this system.


**Setup**

Seedorder is written in PHP with Twig templates using html and css.

**Packages used**

Packages are installed by using Composer:

Twig

Phpmailer

iconv [due to a secondary system that requires text in latin1]

**Configuration**

Config parameters are picked up from a config file immediately outside of webroot: seedorder_config.ini
It is read with the PHP function parse_ini_file(), and contains the following (four sections):

[email]

ORG_USE_SMTP = Set to 1 if Phpmailer should use SMTP for sending emails

MY_SMTP_HOSTNAME = SMTP hostname url

MY_SMTP_USER = SMTP user for authentication (SSL, port 465)

MY_SMTP_PASSWD = SMTP user password

[organisation]

ORG_NAME = Organisation name

ORG_FEE = Seedorder administrative fee 

[communication]

ORG_SENDER_EMAIL = Email address sending confirmation emails

ORG_SENDER_NAME = Name of sender

ORG_CONFIRMATION_SUBJECT = Subject of confirmation emails

ORG_EMAIL_LOG_DIR = directory for email logs (outside webroot)

ORG_LOGO_IMG = Organisation logo image (including path. Inside webroot)

ORG_HEADER = Seedorder web page header

ORG_URL = Organisation home page url (to return to after seedorder is done)

[seed_orders]

ORG_ORDERS_DIR = directory for seedorder files (outside webroot)

ORG_ORDERING_START = Starting date for accepting seed orders (YYYY-MM-DD)

ORG_ORDERING_END = End date for seed orders (YYYY-MM-DD)

ORG_ORDERING_GRACE_DATE = The real end date for seed orders (YYYY-MM-DD)

ORG_SECOND_START = Secondary ordering start date (YYYY-MM-DD)

ORG_SECOND_END = Secondary ordering end date (YYYY-MM-DD)

[other]

CONVERT_TO_LATIN1 = Set to 1 if seed orders should be saved in iso-8859-1 format (latin1)



