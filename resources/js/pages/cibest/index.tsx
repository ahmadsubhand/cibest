import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { formatFileSize } from '@/lib/utils';
import { cibest, cibestUpload, importJobs as importLink } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, router, usePage } from '@inertiajs/react';
import { FileIcon, HardDrive, Upload } from 'lucide-react';
import { ChangeEvent, useRef, useState, useEffect } from 'react';
import { DataTable } from '@/components/table-error/data-table';
import { columns } from '@/components/table-error/column';
import { toast } from 'sonner';
import { Spinner } from '@/components/ui/spinner';
import ImportJobsTable from '@/components/import-jobs/import-jobs-table';
import { ImportJob } from '@/types/import-job';
import axios from 'axios';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'BPRS',
    href: cibest().url,
  },
];

export default function Cibest() {
  const inputRef = useRef<HTMLInputElement>(null);
  const [file, setFile] = useState<File | null>(null);
  const [isLoading, setIsLoading] = useState(false);
  const [importJobs, setImportJobs] = useState<ImportJob[]>([]);
  const { flash } = usePage().props as {
    flash?: {
      success?: string;
      importError?: {
        row: number;
        attribute: string;
        error: string;
        value: string;
      }[]
    };
  };

  // Load import jobs on component mount
  useEffect(() => {
    loadImportJobs(setImportJobs);
  }, []);

  function handleFileChange(e: ChangeEvent<HTMLInputElement>) {
    if (e.target.files) {
      const selectedFile = e.target.files[0];
      if (selectedFile) {
        const fileExtension = selectedFile.name.split('.').pop()?.toLowerCase();
        const validExtensions = ['xlsx', 'xls', 'csv'];

        if (validExtensions.includes(fileExtension || '')) {
          setFile(selectedFile);
        } else {
          toast.error('Format file tidak valid. Harap upload file dengan format .xlsx, .xls, atau .csv');
          if (inputRef.current) {
            inputRef.current.value = ''; // Reset the input
          }
        }
      }
    }
  }

  async function handleFileUpload() {
    if (!file) return;

    router.post(cibestUpload.url(), {
      file: file
    }, {
      onStart: () => {
        setIsLoading(true);
        return true;
      },
      onFinish: () => {
        setIsLoading(false);
        // Reload import jobs after upload
        loadImportJobs(setImportJobs);
      },
      onSuccess: () => {
        if (flash?.success) {
          toast.success(flash.success);
        }
      },
      onError: () => {
        toast.error('Gagal mengupload file');
      },
    });
  }

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Survei CIBEST" />
      <div className="flex h-full flex-col flex-1 gap-4 overflow-x-auto rounded-xl p-4 bg-gray-50">
        <h1 className='font-bold text-2xl text-teal-600'>Survei BPRS</h1>
        <p className="text-gray-600">
          Unduh template excel <a href="/Template Cibest.xlsx" className='text-teal-600 underline underline-offset-4 hover:text-teal-800'>disini</a>
        </p>

        <div className='flex flex-col w-full max-w-md bg-white p-6 rounded-lg shadow-md'>
          <input
            ref={inputRef}
            type="file"
            accept=".xlsx,.xls,.csv"
            className="hidden"
            onChange={handleFileChange}
          />

          <Button
            variant="outline"
            onClick={() => inputRef.current?.click()}
            className="flex items-center gap-2 bg-teal-500 text-white hover:text-white hover:bg-teal-600 w-full py-3"
          >
            <Upload className="h-4 w-4" />
            Upload File
          </Button>

          {file ? (
            <div className='flex flex-col gap-2 mt-4'>
              <p className='text-sm flex gap-2 items-center text-gray-700'><FileIcon className="text-teal-600" /> {file.name}</p>
              <p className='text-sm flex gap-2 items-center text-gray-700'><HardDrive className="text-teal-600" /> {formatFileSize(file.size)}</p>
            </div>
          ) : (
            <p className='text-sm text-gray-500 mt-4'>* Format yang diperbolehkan: xlsx, xls, csv</p>
          )}

          <Button
            onClick={handleFileUpload}
            disabled={isLoading || !file}
            className="mt-4 bg-yellow-500 hover:bg-yellow-600 text-white py-3 text-lg"
          >
            {isLoading && <Spinner />}
            Submit
          </Button>
        </div>

        {/* Show import jobs list */}
        <ImportJobsTable data={importJobs} type="cibest" />

        {/* Show individual errors from flash if any */}
        {
          flash?.importError && flash.importError.length > 0 && (
            <div className="w-full h-fit flex flex-col gap-4 overflow-auto bg-white p-6 rounded-lg shadow-md">
              <p className='text-destructive font-semibold'><b>{flash.importError.length}</b> &nbsp; input tidak memenuhi standar data</p>
              <DataTable columns={columns} data={flash?.importError} />
            </div>
          )
        }
      </div>
    </AppLayout>
  );
}

 function loadImportJobs(setImportJobs: React.Dispatch<React.SetStateAction<ImportJob[]>>) {
    axios.get(importLink.url(), { params: { type: 'cibest' } })
      .then(response => {
        setImportJobs(response.data.data);
      })
      .catch(error => {
        console.error('Failed to load import jobs:', error);
        toast.error('Gagal memuat riwayat import');
      })
  }
