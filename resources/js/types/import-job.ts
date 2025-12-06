export interface ImportJob {
  id: number;
  job_id: number;
  type: string;
  filename: string;
  user_id: number;
  status: 'pending' | 'processing' | 'completed' | 'failed';
  errors: ImportJobError[] | null; // JSON string of errors if any
  total_rows: number | null;
  processed_rows: number | null;
  started_at: string | null;
  completed_at: string | null;
  created_at: string;
  updated_at: string;
}

export interface ImportJobError {
  row: number;
  attribute: string;
  error: string;
  value: string;
}