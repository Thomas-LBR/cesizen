# MLD CESIZen

```text
USERS(
  id PK,
  firstname,
  lastname,
  email UNIQUE,
  password_hash,
  role,
  is_active,
  reset_token,
  reset_expires_at,
  created_at,
  updated_at
)

PAGES(
  id PK,
  title,
  slug UNIQUE,
  summary,
  content,
  is_published,
  created_at,
  updated_at
)

DIAGNOSTIC_EVENTS(
  id PK,
  label,
  points,
  is_active,
  created_at,
  updated_at
)

DIAGNOSTIC_RESULTS(
  id PK,
  user_id FK -> USERS.id,
  score,
  level,
  message,
  selected_events,
  created_at,
  updated_at
)
```
