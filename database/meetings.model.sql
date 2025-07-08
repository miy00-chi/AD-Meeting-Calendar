CREATE TABLE IF NOT EXISTS public."meetings" (
    id uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    title varchar(225) NOT NULL,
    description text,
    meeting_date date NOT NULL,
    start_time time NOT NULL,
    end_time time NOT NULL,
    location varchar(225),
    meeting_link varchar(500),
    status varchar(50) DEFAULT 'scheduled',
    created_by uuid NOT NULL REFERENCES users (id),
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP
);