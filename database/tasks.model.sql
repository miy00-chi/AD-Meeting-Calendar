CREATE TABLE IF NOT EXISTS public."tasks" (
    id uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    title varchar(225) NOT NULL,
    description text,
    meeting_id uuid NOT NULL REFERENCES meetings (id) ON DELETE CASCADE,
    assigned_to uuid REFERENCES users (id) ON DELETE SET NULL,
    priority varchar(20) DEFAULT 'medium',
    status varchar(50) DEFAULT 'pending',
    due_date date,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);