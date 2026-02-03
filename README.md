# DepEd Loan System

## OTP Registration + Gmail Setup

Registration now uses **OTP (One-Time Password)** sent to the user’s email. The account is created only after the OTP is confirmed.

### 1. Install PHP dependencies (PHPMailer)

In the project folder, run:

```bash
composer install
```

If you don’t have Composer: https://getcomposer.org/download/

### 2. Gmail setup (step by step)

Use a **Gmail account** that will send the OTP emails (e.g. your school or system Gmail). You will turn on 2-Step Verification, then create an **App Password** for the DepEd Loan app.

---

#### Step 2.1 — Open Google Account

1. Go to: **https://myaccount.google.com**
2. Sign in with the Gmail address you want to use (e.g. `depedloan@gmail.com`).

---

#### Step 2.2 — Turn on 2-Step Verification

1. In the left menu, click **Security** (or go to https://myaccount.google.com/security).
2. Under **“How you sign in to Google”**, find **2-Step Verification**.
3. Click **2-Step Verification**.
4. If it says **OFF**:
   - Click **Get started**.
   - Enter your Gmail password if asked.
   - Add your **phone number** and choose **Text message** or **Phone call**.
   - Enter the code Google sends you, then click **Next** → **Turn on**.
5. When 2-Step Verification is **ON**, you can create an App Password.

---

#### Step 2.3 — Create an App Password

**Important:** “App passwords” is **not** in the “Second steps” list (Passkeys, Google prompt, Authenticator, Phone, Backup codes). It’s a **separate** option.

**Option A — Direct link (easiest)**

1. Make sure **2-Step Verification is ON** (you already did this).
2. Open this link while signed in to your Google account:  
   **https://myaccount.google.com/apppasswords**
3. If the page loads:
   - In **“Select app”** choose **Mail**.
   - In **“Select device”** choose **Other (Custom name)** and type **DepEd Loan**.
   - Click **Generate**.
   - Copy the **16-character password** and paste it into `config_email.php` as `MAIL_SMTP_PASS`.
4. If the link says **“App passwords are not available”** or you get an error → use **Option B** below.

**Option B — Find it in Security**

1. Go to **https://myaccount.google.com/security**
2. Under **“How you sign in to Google”**, click **2-Step Verification** (the text link, not the ON/OFF switch).
3. You should see a page titled **2-Step Verification** with sections like “Add more second steps”.
4. **Scroll to the bottom** of that same page. There should be a section **“App passwords”** with a link or button.
5. Click it, then choose **Mail** → **Other (Custom name)** → **DepEd Loan** → **Generate**, and copy the 16-character password.

**If you still don’t see “App passwords”**

- **Work or school Google account** (e.g. @deped.gov.ph, @school.edu.ph): Many organizations **disable** App passwords. You have two choices:
  1. **Use a personal Gmail** (@gmail.com) only for sending OTP: create an App Password on that personal account and put it in `config_email.php`. Users can still register with any email (school or personal); only the *sender* of the OTP needs to be that Gmail.
  2. Ask your **IT / Google Workspace admin** to allow “App passwords” for your account or org.
- **Personal @gmail.com**: If 2-Step Verification is ON and the direct link above still says “not available”, try signing out and back in, or use a different browser, then open https://myaccount.google.com/apppasswords again.

---

#### Step 2.4 — Put the App Password in your project

1. Open the file **`config_email.php`** in your project folder.
2. Set these three values:

| Setting | What to put |
|--------|----------------|
| `MAIL_FROM_EMAIL` | Your Gmail address (e.g. `depedloan@gmail.com`) |
| `MAIL_SMTP_USER`  | Same Gmail address |
| `MAIL_SMTP_PASS`  | The 16-character App Password (no spaces, e.g. `abcdefghijklmnop`) |

Example:

```php
define('MAIL_FROM_EMAIL', 'depedloan@gmail.com');
define('MAIL_SMTP_USER', 'depedloan@gmail.com');
define('MAIL_SMTP_PASS', 'abcdefghijklmnop');   // App Password from Step 2.3
```

3. Save the file.

---

#### Quick reference

| Step | Where | What to do |
|------|--------|------------|
| 2.1 | https://myaccount.google.com | Sign in with Gmail |
| 2.2 | Security → 2-Step Verification | Turn ON 2-Step Verification (add phone) |
| 2.3 | 2-Step Verification → App passwords | Create App Password for “Mail” + “DepEd Loan” |
| 2.4 | `config_email.php` | Paste Gmail and App Password |

### 3. Registration flow

1. User fills the registration form and clicks **“Send OTP to Email”**.  
2. System validates the form and sends a 6-digit OTP to the user’s email (via Gmail).  
3. User enters the OTP and clicks **“Verify & Create Account”**.  
4. If the OTP is correct, the account is created and the user can log in.

OTP expires after **10 minutes**. User can go back to the form and request a new OTP.
