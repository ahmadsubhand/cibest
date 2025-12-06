import axios from 'axios';
import { ImportJob } from '@/types/import-job';

interface ImportJobsResponse {
  data: ImportJob[];
  links: {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
  };
  meta: {
    current_page: number;
    from: number;
    last_page: number;
    links: {
      url: string | null;
      label: string;
      active: boolean;
    }[];
    path: string;
    per_page: number;
    to: number;
    total: number;
  };
}

export async function getImportJobs(type: string): Promise<ImportJobsResponse> {
  const response = await axios.get<ImportJobsResponse>('/api/import-jobs', {
    params: {
      type: type,
    },
  });
  
  return response.data;
}