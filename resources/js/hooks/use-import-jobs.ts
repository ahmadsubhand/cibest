import { ImportJob } from '@/types/import-job';
import { getImportJobs } from '@/api/import-jobs';

export function useImportJobs(type: string) {
  return getImportJobs(type);
}