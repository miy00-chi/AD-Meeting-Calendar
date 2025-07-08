CREATE TABLE IF NOT EXISTS public."meeting_users" (
    meeting_id uuid NOT NULL REFERENCES meetings (id) ON DELETE CASCADE,
    user_id uuid NOT NULL REFERENCES users (id) ON DELETE CASCADE,
    role varchar(50) DEFAULT 'attendee',
    status varchar(50) DEFAULT 'invited',
    invited_at timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (meeting_id, user_id)
);