import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, router, usePage } from '@inertiajs/react';
import { Clock, FileIcon, Play, CheckCircle, AlertCircle } from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import { DataTable } from '@/components/table-error/data-table';
import { columns } from '@/components/table-error/column';
import { ImportJob } from '@/types/import-job';
import { baznas, cibest } from '@/routes';

export default function ImportJobDetail() {
  const { props } = usePage();
  const importJob = props.importJob as ImportJob;
  const errors = importJob.errors || [];

  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: importJob.type === 'cibest' ? 'BPRS' : 'BAZNAS',
      href: importJob.type === 'cibest' ? '/bprs' : '/baznas',
    },
    {
      title: 'Detail Import',
      href: '#',
    },
  ];

  // Format status with badge
  const getStatusBadge = () => {
    let variant: "default" | "secondary" | "destructive" | "outline" | "ghost" = "default";
    let icon = null;

    switch (importJob.status) {
      case 'pending':
        variant = 'secondary';
        icon = <Clock className="mr-2 h-4 w-4" />;
        break;
      case 'processing':
        variant = 'secondary';
        icon = <Play className="mr-2 h-4 w-4" />;
        break;
      case 'completed':
        variant = 'default';
        icon = <CheckCircle className="mr-2 h-4 w-4" />;
        break;
      case 'failed':
        variant = 'destructive';
        icon = <AlertCircle className="mr-2 h-4 w-4" />;
        break;
      default:
        variant = 'default';
    }

    return (
      <Badge variant={variant}>
        {icon}
        {importJob.status.charAt(0).toUpperCase() + importJob.status.slice(1)}
      </Badge>
    );
  };

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title={`Detail Import - ${importJob.filename}`} />
      <div className="flex h-full flex-col flex-1 gap-4 overflow-x-auto rounded-xl p-4 bg-gray-50">
        <div className="flex justify-between items-center">
          <h1 className='font-bold text-2xl text-teal-600'>Detail Import</h1>
          <Button variant="outline" onClick={() => router.visit(importJob.type === 'baznas' ? baznas.url() : cibest.url())}>
            Kembali
          </Button>
        </div>

        <div className="bg-white p-6 rounded-lg shadow-md">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div className="flex flex-col gap-4">
              <div className="flex items-center gap-2">
                <FileIcon className="text-teal-600" />
                <span className="font-medium">{importJob.filename}</span>
              </div>
              <div>
                <p className="text-sm text-gray-600">Tipe Import</p>
                <p className="font-medium">{importJob.type.toUpperCase()}</p>
              </div>
              <div>
                <p className="text-sm text-gray-600">Status</p>
                <div>{getStatusBadge()}</div>
              </div>
            </div>
            <div className="flex flex-col gap-4">
              <div>
                <p className="text-sm text-gray-600">Dimulai Pada</p>
                <p className="font-medium">
                  {importJob.started_at ? new Date(importJob.started_at).toLocaleString('id-ID') : '-'}
                </p>
              </div>
              <div>
                <p className="text-sm text-gray-600">Selesai Pada</p>
                <p className="font-medium">
                  {importJob.completed_at ? new Date(importJob.completed_at).toLocaleString('id-ID') : '-'}
                </p>
              </div>
              <div>
                <p className="text-sm text-gray-600">Jumlah Baris</p>
                <p className="font-medium">{importJob.total_rows || 0}</p>
              </div>
              <div>
                <p className="text-sm text-gray-600">Baris Diproses</p>
                <p className="font-medium">{importJob.processed_rows || 0}</p>
              </div>
            </div>
          </div>
        </div>

        {/* Show error details if any */}
        {errors.length > 0 && (
          <div className="w-full h-fit flex flex-col gap-4 overflow-auto bg-white p-6 rounded-lg shadow-md">
            <p className='text-destructive font-semibold'><b>{errors.length}</b> &nbsp; input tidak memenuhi standar data</p>
            <DataTable columns={columns} data={errors} />
          </div>
        )}

        {errors.length === 0 && (
          <div className="w-full h-fit flex flex-col gap-4 overflow-auto bg-white p-6 rounded-lg shadow-md">
            <p className="text-success font-semibold">Tidak ada kesalahan pada proses import</p>
          </div>
        )}
      </div>
    </AppLayout>
  );
}