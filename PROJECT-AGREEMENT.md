# PROJECT AGREEMENT & DEVELOPMENT PLAN

> **Status:** Draft v1.0 — pending Hatem's approval of the final structure tree.
> **Reference site:** https://qoraanonline.com/
> **This file is the contract.** No file, feature, or commit exists outside it. Changes to scope require an amendment commit to this document first.

---

## 1. PROJECT IDENTITY

| Field | Value |
|---|---|
| **Theme Name** | **SurahSuite** |
| **Theme Slug** | `surahsuite` |
| **Plugin Name** | **SurahSuite Core** |
| **Plugin Slug** | `surahsuite-core` |
| **Text Domain** | `surahsuite` (theme), `surahsuite-core` (plugin) |
| **Author** | Hatem Frere |
| **Author URL** | https://hatemfrere.freehosting.dev/ |
| **GitHub Account** | https://github.com/hatem-frere/ |
| **Repository** | *(to be created in Phase 0 — name: `surahsuite`)* |
| **Primary Reference** | https://qoraanonline.com/ |
| **License** | GPL v2 or later |
| **Commercial Goal** | Sale as a self-contained theme + custom plugin bundle (ThemeForest-grade) |

---

## 2. PROJECT DESCRIPTION

A fully self-contained WordPress theme and custom plugin for a Quran memorization and teaching platform. The platform connects **Quran instructors** (with verifiable Ijazah credentials, defined availability, and pricing) with **students** (children and adults) who browse, filter, book, and pay for sessions — either one-time or via monthly subscription plans.

**Zero third-party platform dependencies:** no WooCommerce, no third-party LMS (LearnDash, TutorLMS, Masteriyo, LifterLMS, etc.), no booking SaaS. All logic — user roles, teacher profiles, availability, booking, plans, payments, dashboards — lives in the custom plugin `surahsuite-core`. Payment gateways (Stripe, PayPal) are integrated via their official PHP SDKs directly, not via any platform plugin.

**Target audience for the product:** Islamic education centers, individual Quran teachers, masjid-based academies, and online Quran institutes who want a turnkey, professionally engineered platform.

**Build standard:** Booking.com-level transactional reliability. Every user flow (register → browse → book → pay → cancel → refund) must work flawlessly in both LTR and RTL, on desktop and mobile, in Arabic and English.

---

## 3. COLLABORATION GROUND RULES (BINDING)

### 3.1 Authority & Decision-Making
- **Hatem makes all architectural decisions.** The assistant provides options and recommendations but never decides alone.
- Any ambiguity is **discussed and agreed before code is written**. No assumptions.

### 3.2 File Delivery Rules
- The assistant provides the **complete code** for every file — new or modified — always inside a fenced code block, with the **exact file path stated above the block**.
- **Never snippets, never diffs, never partial files.** This rule exists to prevent copy-paste errors.
- The assistant must **request the current file contents before modifying** any existing file. The assistant must not rely on memory of a prior version.
- **The assistant cannot produce actual downloadable attachments in this interface.** Complete file content is delivered as text; Hatem saves it in VS Code. This is the agreed equivalent of a downloadable file.

### 3.3 Explanation Requirements
- Every file, class, function, or modification is **explained**: its purpose and its expected outcome.
- Every terminal command is **explained**: what it does and its expected output, *before* it is run.

### 3.4 Terminal Discipline
- All work is done via the **VS Code integrated terminal (CMD, Windows)** — not PowerShell, not a separate shell.
- After each command or WordPress action, Hatem reports the **actual output**, and the assistant analyses it and issues fixes immediately if needed.

### 3.5 Git Discipline
- Each completed file or logical group of files is committed with a **descriptive message** and pushed to GitHub **before moving to the next step**.
- No phase advances until the previous phase is **stable and committed**.
- Commit message convention: `type(scope): summary` — e.g., `feat(booking): add slot calculator`, `fix(auth): sanitize registration email`.

### 3.6 Code Standards (ThemeForest-grade)
- **WordPress Coding Standards (WPCS)** enforced via PHPCS.
- **All vendor libraries are local** — no CDN references, ever (Swiper, GLightbox, intl-tel-input, Stripe SDK, PayPal SDK).
- **All strings translatable** (`__()`, `_e()`, `esc_html__()`, etc., with correct text domain).
- **All inputs sanitized, all outputs escaped, all nonces verified, all capabilities checked.**
- **All custom SQL uses `$wpdb->prepare()`.**
- **No third-party API credentials hardcoded** — Stripe/PayPal keys, webhook secrets, SMTP credentials are all configurable via admin settings, stored in `wp_options`.

---

## 4. TECHNICAL STACK (LOCKED)

| Layer | Technology |
|---|---|
| Platform | WordPress (latest stable) |
| Language | PHP 8.0+ |
| Database | MySQL via `$wpdb`, custom tables (prefix-aware) |
| Admin JS | jQuery + WP Media Library + jQuery UI Sortable |
| Frontend JS | Vanilla JS namespaced object + jQuery |
| Slider | Swiper.js v11 (local vendor) |
| Lightbox | GLightbox v3.3.0 (local vendor) |
| Phone input | intl-tel-input v29.1.0 (local vendor) |
| Payment SDKs | Stripe PHP SDK, PayPal Checkout SDK (local vendor) |
| Styling | Custom CSS with CSS variables |
| Code Standard | WordPress Coding Standards (WPCS) |
| Version Control | Git + GitHub |
| Local Environment | XAMPP on Windows (drive E:) |
| Editor | VS Code + integrated CMD terminal |

---

## 5. WORK METHODOLOGY

1. **Phase-based development** — no phase begins until the previous is stable and committed.
2. **File-by-file approach** — each file is written completely (code, comments, docblocks) before the next is started.
3. **Complete code always** — no partial files, ever.
4. **Git discipline** — descriptive commits, push after each completed step.
5. **Provide before asking** — the current complete file is shared before any modification.
6. **Expected results stated always** — every command and every WordPress action is preceded by its expected outcome.
7. **ThemeForest standards** — local vendors, WPCS, i18n, sanitization, nonces — non-negotiable.

---

## 6. DEVELOPMENT PHASES

> Each phase is only begun after the prior phase's final commit is pushed to GitHub and verified stable.

### PHASE 0 — FOUNDATION & ENVIRONMENT

**Goal:** A working local WordPress install, a clean Git repo linked to GitHub, and the two directory trees (theme + plugin) scaffolded with placeholder files.

| # | Task | Deliverable |
|---|---|---|
| 0.1 | Verify XAMPP (Apache + MySQL running) and PHP ≥ 8.0 | Terminal output of `php -v` and `http://localhost` |
| 0.2 | Create project root `E:\xampp\htdocs\surahsuite` and a fresh local WordPress install under it | WP admin reachable at `http://localhost/surahsuite/wp-admin` |
| 0.3 | Create GitHub repository `surahsuite` under `hatem-frere` | Repo URL confirmed |
| 0.4 | `git init`, `.gitignore`, first commit, `git remote add`, `git push` | `main` branch on GitHub with `.gitignore` |
| 0.5 | Scaffold theme folder `wp-content/themes/surahsuite/` with empty `style.css` + `index.php` (valid WP theme headers) | Theme appears in WP admin |
| 0.6 | Scaffold plugin folder `wp-content/plugins/surahsuite-core/` with empty `surahsuite-core.php` (valid plugin headers) | Plugin appears in WP admin |
| 0.7 | Install and configure PHPCS + WPCS in VS Code (via Composer, global or per-project) | `phpcs --version` passes |
| 0.8 | Commit + push: `chore: phase 0 foundation scaffolded` | Verified on GitHub |

**Exit criteria:** WP admin shows the theme and plugin (both inactive/empty), repo is live on GitHub with `.gitignore` covering `/wp-admin`, `/wp-includes`, `/wp-content/uploads`, `wp-config.php`, `/vendor` (per-project), `.env`, `*.log`.

---

### PHASE 1 — DATABASE & CORE PLUGIN ARCHITECTURE

**Goal:** The plugin's skeleton — OOP architecture, autoloader, DB schema, roles, settings — fully functional before any feature.

| # | Task | Deliverable |
|---|---|---|
| 1.1 | Plugin bootstrap: `surahsuite-core.php` (headers, `SURAHSUITE_CORE_*` constants, guards), PSR-4-style autoloader | Plugin loads without errors |
| 1.2 | Main plugin class `SurahSuite_Core` (singleton, module loader) | `SurahSuite_Core::instance()` reachable |
| 1.3 | Activation / Deactivation classes; `uninstall.php` (respects "preserve data" toggle) | Activation creates tables; uninstall respects toggle |
| 1.4 | `SurahSuite_DB` schema class: creates custom tables via `dbDelta()` | Tables created on activation |
| 1.5 | `SurahSuite_Roles` class: registers `quran_teacher`, `quran_student`, `quran_parent`, `quran_admin` | Roles present on activation |
| 1.6 | `SurahSuite_Settings` class: Settings API wrapper; a single "General" page | Settings page renders and saves |
| 1.7 | `SurahSuite_Security` class: helper methods for nonce generation, sanitization wrappers, capability checks | Unit-tested helpers |
| 1.8 | `SurahSuite_Logger` class: minimal file-based logger | Log file created on demand |
| 1.9 | Commit + push: `feat(core): plugin skeleton, DB schema, roles, settings, security helpers` | Verified on GitHub |

**DB tables created in this phase (final schema frozen here unless amended):**
- `wp_surahsuite_teacher_profiles` — user_id, ijazah_level, gender, bio, hourly_rate, languages, session_types, status, timestamps
- `wp_surahsuite_teacher_availability` — id, teacher_id, weekday, start_time, end_time, timezone, is_recurring, valid_from, valid_until
- `wp_surahsuite_plans` — id, name, slug, price, currency, duration_days, session_count, description, status
- `wp_surahsuite_bookings` — id, student_id, teacher_id, plan_id (nullable), session_type, start_utc, end_utc, status, price, currency, notes, timestamps
- `wp_surahsuite_transactions` — id, booking_id, plan_id, gateway, gateway_txn_id, amount, currency, status, raw_response (JSON), timestamps
- `wp_surahsuite_subscriptions` — id, student_id, plan_id, gateway, gateway_sub_id, status, next_billing_utc, timestamps

**Exit criteria:** Deactivate/reactivate plugin — tables persist. Roles present. General settings save. All files WPCS-clean.

---

### PHASE 2 — AUTHENTICATION & USER MANAGEMENT

**Goal:** Front-end registration, login, password reset, and profiles — for both teachers and students — with full validation, honeypot/rate-limit, and email verification.

| # | Task | Deliverable |
|---|---|---|
| 2.1 | `SurahSuite_Registration` class: teacher + student registration forms (shortcode `[surahsuite_register role="teacher|student"]`), validated server-side | Registered user appears with correct role |
| 2.2 | `SurahSuite_Login` class: front-end login shortcode `[surahsuite_login]`, rate-limited, nonce-protected | Login works; brute-force throttled |
| 2.3 | `SurahSuite_Password_Reset` class: front-end reset flow using WP's native reset keys | Reset email received and flow completes |
| 2.4 | Teacher profile creation on registration: capture ijazah, gender, bio, rate, languages → write to `surahsuite_teacher_profiles` | Row created on teacher register |
| 2.5 | Student profile: minimal (no custom table; use `usermeta`) — name, age group, parent link (optional) | Saved to usermeta |
| 2.6 | Front-end profile editing shortcode `[surahsuite_profile]` | Users can edit and save own profile |
| 2.7 | Email templates via `SurahSuite_Emails` class, editable in admin | Emails render with placeholders |
| 2.8 | Commit + push: `feat(auth): registration, login, password reset, profiles` | Verified |

**Exit criteria:** Full registration → email verify → login → edit profile → reset password flow works for both roles, with all security guards.

---

### PHASE 3 — TEACHER MODULE

**Goal:** Teachers manage availability; students browse, filter, and view teachers.

| # | Task | Deliverable |
|---|---|---|
| 3.1 | `SurahSuite_Teacher_Repository` — CRUD for teacher profiles and availability | Class instantiable and unit-tested |
| 3.2 | Teacher availability UI (front-end shortcode `[surahsuite_availability]`): weekday grid, time ranges, timezone | Teacher saves weekly availability |
| 3.3 | `SurahSuite_Teacher_Controller` — handles AJAX save of availability, validated + nonce-checked | AJAX returns structured JSON |
| 3.4 | Teacher directory shortcode `[surahsuite_teachers]` — grid + filters (gender, ijazah, price range, language, session type) | Directory renders, filters work via AJAX |
| 3.5 | Teacher single profile shortcode `[surahsuite_teacher id="X"]` — bio, ijazah, availability preview, "Book" CTA | Profile page renders |
| 3.6 | Commit + push: `feat(teachers): availability manager, directory, profile` | Verified |

**Exit criteria:** A teacher registers, sets availability, appears in directory with correct filters, and a public profile page loads with a Book button.

---

### PHASE 4 — PLANS & BOOKING ENGINE

**Goal:** Plans CRUD; student browses plans; booking flow computes free slots and reserves them atomically.

| # | Task | Deliverable |
|---|---|---|
| 4.1 | `SurahSuite_Plan_Repository` — CRUD over `surahsuite_plans` | Admin can create/edit/delete plans |
| 4.2 | `[surahsuite_plans]` shortcode — cards for each plan | Plans render |
| 4.3 | `SurahSuite_Slot_Calculator` — given teacher + date, returns free 30-min (configurable) slots | Slot endpoint returns JSON array |
| 4.4 | `[surahsuite_booking teacher="X"]` — date picker + slot picker + confirm | Booking form works |
| 4.5 | `SurahSuite_Booking_Ajax` — nonce-protected handlers: `get_slots`, `create_booking` | AJAX endpoints respond |
| 4.6 | **Race-condition guard:** `create_booking` runs inside a `SELECT ... FOR UPDATE` transaction and re-verifies the slot is free before INSERT | Concurrent double-booking impossible |
| 4.7 | Booking statuses: `pending` → `confirmed` → `completed` / `cancelled` / `refunded` | State machine documented and enforced |
| 4.8 | Cancellation logic with configurable refund window | Cancel updates status + triggers refund hook |
| 4.9 | Commit + push: `feat(booking): plans, slot calculator, booking flow, race guard` | Verified |

**Exit criteria:** Two simultaneous browsers cannot double-book the same slot; cancellation works; statuses transition correctly.

---

### PHASE 5 — PAYMENTS (STRIPE + PAYPAL)

**Goal:** Server-verified payments for one-time bookings and recurring plans; no credential hardcoding.

| # | Task | Deliverable |
|---|---|---|
| 5.1 | `Payment_Gateway` interface — uniform API for init, verify, refund | Interface defined |
| 5.2 | Admin settings page "Payments" — Stripe keys, PayPal keys, webhook secrets | Settings save |
| 5.3 | `SurahSuite_Stripe_Gateway` — Payment Intent creation, webhook verification, refund | Stripe test-mode payment completes |
| 5.4 | `SurahSuite_PayPal_Gateway` — order creation, capture, webhook, refund | PayPal sandbox completes |
| 5.5 | `SurahSuite_Webhook_Handler` — REST endpoints for `/wp-json/surahsuite/v1/webhook/{gateway}`; validates signature | Forged webhooks rejected |
| 5.6 | Subscription flow (Stripe Subscriptions / PayPal Subscriptions) | Monthly plan active |
| 5.7 | `SurahSuite_Transaction_Repository` — logs every payment attempt | Transactions visible in admin |
| 5.8 | Commit + push: `feat(payments): Stripe + PayPal, webhooks, subscriptions, refunds` | Verified |

**Exit criteria:** A booking paid via Stripe test mode → status becomes `confirmed` and `transactions` row is `succeeded`. Same for PayPal sandbox. Refund path works. Webhook signature verification rejects forged requests.

---

### PHASE 6 — THEME DEVELOPMENT

**Goal:** The design layer. RTL-first, responsive, matching the reference site's UX (hero, features, teachers, steps, plans, stats, dashboards).

| # | Task | Deliverable |
|---|---|---|
| 6.1 | Theme scaffold: `style.css`, `functions.php`, `index.php`, `inc/` structure | Theme activates |
| 6.2 | `inc/theme-setup.php` — `add_theme_support()` calls incl. `rtl`, custom logo | Support flags active |
| 6.3 | `inc/enqueue.php` — conditionally enqueue theme CSS/JS + local vendor libs | Assets load only where needed |
| 6.4 | `header.php` + `footer.php` — nav, user menu, language switcher | Header/footer render |
| 6.5 | `front-page.php` + `template-parts/home/*` — hero, why-us, teachers grid, steps, plans, stats | Homepage matches design |
| 6.6 | `page-templates/template-teachers.php`, `template-plans.php`, `template-dashboard.php`, `template-login.php`, `template-register.php` | Templates selectable |
| 6.7 | `template-parts/dashboard/*` — student and teacher dashboards | Dashboards render |
| 6.8 | `rtl.css` — full RTL mirror | Arabic site mirrors cleanly |
| 6.9 | Style the plugin shortcodes | All shortcodes match design |
| 6.10 | `inc/tgm-activation.php` — TGM Plugin Activation prompts buyer to install `surahsuite-core` | Fresh theme install prompts for plugin |
| 6.11 | Commit + push: `feat(theme): scaffold, templates, homepage, RTL, shortcode styling` | Verified |

**Exit criteria:** Homepage matches reference site structure. RTL is clean. All shortcodes render beautifully. Site degrades gracefully (theme-only, no plugin) with a notice to install the plugin.

---

### PHASE 7 — SECURITY, PERFORMANCE, QA

**Goal:** The product is provably secure, performant, and documented.

| # | Task | Deliverable |
|---|---|---|
| 7.1 | Full security audit: nonces everywhere, all inputs sanitized, all outputs escaped, all queries prepared, all capabilities checked | Zero flags from PHPCS + manual audit |
| 7.2 | Performance: conditional enqueues, minified assets, DB indexes on `teacher_id`, `student_id`, `start_utc`, `status` | PageSpeed ≥ 85 desktop |
| 7.3 | i18n audit: every string translatable; generate `surahsuite.pot` and `surahsuite-core.pot` | POEdit load works |
| 7.4 | Cross-browser + mobile test matrix | All pass |
| 7.5 | Plugin-only mode test (activate with default theme) | Plugin functions stand-alone |
| 7.6 | Theme-only mode test (activate with default WP, plugin inactive) | Theme degrades gracefully |
| 7.7 | `readme.txt` for theme and plugin, plus full user documentation (`/docs/`) | Docs complete |
| 7.8 | Commit + push: `chore(qa): security audit, perf, i18n, docs` | Verified |

**Exit criteria:** Clean security scan; POEdit-loadable POTs; docs complete; ThemeForest reviewer's common rejection reasons addressed.

---

### PHASE 8 — PACKAGING & RELEASE

**Goal:** A sellable ZIP.

| # | Task | Deliverable |
|---|---|---|
| 8.1 | Package structure: `/surahsuite-theme/`, `/surahsuite-core/`, `/documentation/`, `/demo-content/`, `/readme.txt`, `/LICENSE` | `surahsuite-1.0.0.zip` |
| 8.2 | Demo content XML export | Importable |
| 8.3 | License file (GPL v2+) + third-party license notices | Legal compliance |
| 8.4 | Version tagging: `git tag -a v1.0.0 -m "First release"` and push tags | Tag on GitHub |
| 8.5 | Release on GitHub Releases page with the ZIP | Downloadable release |
| 8.6 | Final acceptance test on a fresh WP install using the packaged ZIP | Works end-to-end |

---

## 7. THEME & PLUGIN STRUCTURE TREE

### 7.1 Theme: `wp-content/themes/surahsuite/`
surahsuite/
├── style.css
├── rtl.css
├── index.php
├── functions.php
├── screenshot.png
├── readme.txt
├── LICENSE
├── inc/
│ ├── class-surahsuite-theme.php
│ ├── theme-setup.php
│ ├── enqueue.php
│ ├── template-functions.php
│ ├── template-tags.php
│ ├── customizer.php
│ ├── nav-walker.php
│ └── class-tgm-plugin-activation.php
├── page-templates/
│ ├── template-teachers.php
│ ├── template-plans.php
│ ├── template-dashboard.php
│ ├── template-login.php
│ └── template-register.php
├── template-parts/
│ ├── content-none.php
│ ├── header/
│ │ ├── site-branding.php
│ │ ├── nav-primary.php
│ │ └── nav-user.php
│ ├── footer/
│ │ └── site-info.php
│ ├── home/
│ │ ├── hero.php
│ │ ├── features.php
│ │ ├── teachers.php
│ │ ├── steps.php
│ │ ├── plans.php
│ │ └── stats.php
│ ├── teacher/
│ │ ├── card.php
│ │ └── filter-form.php
│ ├── plan/
│ │ └── card.php
│ └── dashboard/
│ ├── sidebar.php
│ ├── student-bookings.php
│ ├── student-invoices.php
│ ├── teacher-bookings.php
│ └── teacher-earnings.php
├── assets/
│ ├── css/
│ │ ├── main.css
│ │ ├── rtl.css
│ │ ├── dashboard.css
│ │ └── components/
│ │ ├── buttons.css
│ │ ├── forms.css
│ │ ├── cards.css
│ │ └── tables.css
│ ├── js/
│ │ ├── main.js
│ │ ├── navigation.js
│ │ └── dashboard.js
│ ├── images/
│ └── fonts/
├── languages/
│ └── surahsuite.pot
└── vendor/
├── swiper/
│ ├── swiper-bundle.min.css
│ └── swiper-bundle.min.js
├── glightbox/
│ ├── glightbox.min.css
│ └── glightbox.min.js
└── intl-tel-input/
├── css/
│ └── intlTelInput.min.css
└── js/
└── intlTelInput.min.js

### 7.2 Plugin: `wp-content/plugins/surahsuite-core/`
surahsuite-core/
├── surahsuite-core.php
├── uninstall.php
├── readme.txt
├── LICENSE
├── composer.json
├── includes/
│ ├── autoloader.php
│ ├── class-surahsuite-core.php
│ ├── class-activator.php
│ ├── class-deactivator.php
│ ├── class-i18n.php
│ ├── class-loader.php
│ ├── class-capabilities.php
│ ├── class-database.php
│ ├── class-roles.php
│ ├── class-settings.php
│ ├── class-shortcodes.php
│ ├── class-emails.php
│ ├── class-security.php
│ └── class-logger.php
├── modules/
│ ├── teachers/
│ │ ├── class-teachers-module.php
│ │ ├── class-teacher-repository.php
│ │ ├── class-teacher-controller.php
│ │ ├── class-teacher-availability.php
│ │ └── templates/
│ │ ├── profile.php
│ │ └── availability-form.php
│ ├── students/
│ │ ├── class-students-module.php
│ │ ├── class-student-repository.php
│ │ └── class-student-controller.php
│ ├── booking/
│ │ ├── class-booking-module.php
│ │ ├── class-booking-repository.php
│ │ ├── class-booking-controller.php
│ │ ├── class-booking-ajax.php
│ │ ├── class-slot-calculator.php
│ │ └── templates/
│ │ ├── booking-form.php
│ │ └── slots-list.php
│ ├── plans/
│ │ ├── class-plans-module.php
│ │ ├── class-plan-repository.php
│ │ └── class-plan-controller.php
│ ├── payments/
│ │ ├── class-payments-module.php
│ │ ├── class-payment-controller.php
│ │ ├── class-transaction-repository.php
│ │ └── gateways/
│ │ ├── interface-payment-gateway.php
│ │ ├── class-stripe-gateway.php
│ │ ├── class-paypal-gateway.php
│ │ └── class-webhook-handler.php
│ ├── auth/
│ │ ├── class-auth-module.php
│ │ ├── class-registration.php
│ │ ├── class-login.php
│ │ ├── class-password-reset.php
│ │ └── templates/
│ │ ├── register-teacher.php
│ │ ├── register-student.php
│ │ └── login.php
│ └── dashboard/
│ ├── class-dashboard-module.php
│ └── class-dashboard-controller.php
├── admin/
│ ├── class-admin.php
│ ├── class-admin-menu.php
│ ├── class-admin-assets.php
│ └── views/
│ ├── settings-general.php
│ ├── settings-payments.php
│ ├── settings-emails.php
│ ├── page-teachers.php
│ ├── page-plans.php
│ ├── page-bookings.php
│ └── page-transactions.php
├── public/
│ ├── class-public.php
│ ├── class-public-assets.php
│ └── partials/
├── assets/
│ ├── css/
│ │ ├── admin.css
│ │ └── public.css
│ ├── js/
│ │ ├── admin.js
│ │ ├── public.js
│ │ ├── booking.js
│ │ └── availability.js
│ └── images/
├── languages/
│ └── surahsuite-core.pot
└── vendor/
├── stripe/
└── paypal/

---

## 8. RISK REGISTER (TRACKED)

| Risk | Mitigation | Phase |
|---|---|---|
| Double-booking race condition | `SELECT ... FOR UPDATE` + re-verify in transaction | 4.6 |
| Payment credential leakage | `.env` local only; admin settings; never logged | 5.2, 7.1 |
| ThemeForest rejection (theme/plugin coupling) | TGM prompt; theme works without plugin | 6.10, 7.6 |
| RTL layout breakage | RTL-first CSS variables; test in Phase 6.8 | 6.8, 7.4 |
| Timezone drift on bookings | All storage in UTC; frontend converts | 4.3 |
| Vendor CDN accidental inclusion | Grep check in Phase 7.1 | 7.1 |

---

## 9. SCOPE CHANGE PROTOCOL

Any change to this document after Phase 0 is committed **requires an amendment commit** to this file with a clear `## AMENDMENT YYYY-MM-DD` section describing what changed and why, committed **before** the code change. Nothing ships that is not described here first.

---

**Sign-off:**
- Hatem Frere — pending approval of the structure tree.
- Assistant — bound to the terms above until amended in writing.
