import { Button } from '@/components/ui/button';
import { DataTable } from '@/components/table-error/data-table';
import { ImportJob } from '@/types/import-job';
import { ColumnDef } from '@tanstack/react-table';
import { router } from '@inertiajs/react';
import { Clock, Play, CheckCircle, AlertCircle, MoreHorizontal, Trash2, Eye } from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { useState } from 'react';
import { importJobsDestroy, importJobsDetail } from '@/routes';
import { Spinner } from '../ui/spinner';

// Define the columns for the import jobs table
export const importJobColumns: ColumnDef<ImportJob>[] = [
  {
    accessorKey: 'filename',
    header: 'Nama File',
  },
  {
    accessorKey: 'status',
    header: 'Status',
    cell: ({ row }) => {
      const status = row.original.status;
      let variant: "default" | "secondary" | "destructive" | "outline" | "ghost" = "default";
      let icon = null;

      switch (status) {
        case 'pending':
          variant = 'secondary';
          icon = <Clock className="mr-2 h-4 w-4" />;
          break;
        case 'processing':
          variant = 'secondary';
          icon = <Spinner className='mr-2 h-4 w-4'/>;
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
          {status.charAt(0).toUpperCase() + status.slice(1)}
        </Badge>
      );
    },
  },
  {
    accessorKey: 'started_at',
    header: 'Dimulai Pada',
    cell: ({ row }) => {
      const date = row.original.started_at;
      return date ? new Date(date).toLocaleString('id-ID') : '-';
    },
  },
  {
    accessorKey: 'completed_at',
    header: 'Selesai Pada',
    cell: ({ row }) => {
      const date = row.original.completed_at;
      return date ? new Date(date).toLocaleString('id-ID') : '-';
    },
  },
  {
    accessorKey: 'processed_rows',
    header: 'Baris Terproses',
    cell: ({ row }) => {
      return row.original.processed_rows || 0;
    },
  },
  {
    id: 'actions',
    cell: ({ row }) => {
      const importJob = row.original;
      const [showDeleteDialog, setShowDeleteDialog] = useState(false);

      const confirmDelete = () => {
        router.delete(importJobsDestroy.url(importJob.id), {
          onSuccess: () => {
            setShowDeleteDialog(false);
          },
          onError: () => {
            setShowDeleteDialog(false);
          }
        });
      };

      const cancelDelete = () => {
        setShowDeleteDialog(false);
      };

      return (
        <>
          <DropdownMenu>
            <DropdownMenuTrigger asChild>
              <Button variant="ghost" className="h-8 w-8 p-0">
                <span className="sr-only">Open menu</span>
                <MoreHorizontal className="h-4 w-4" />
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
              <DropdownMenuItem
                onClick={() => router.visit(importJobsDetail.url(importJob.id))}
              >
                <Eye className='h-4 w-4' />
                Lihat Detail
              </DropdownMenuItem>
              <DropdownMenuItem
                onClick={() => setShowDeleteDialog(true)}
                className="text-red-600 focus:text-red-600"
              >
                <div className="flex items-center gap-2">
                  <Trash2 className="h-4 w-4 text-red-600" />
                  Hapus
                </div>
              </DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>

          {/* Delete Confirmation Dialog */}
          <Dialog open={showDeleteDialog} onOpenChange={setShowDeleteDialog}>
            <DialogContent>
              <DialogHeader>
                <DialogTitle>Konfirmasi Hapus</DialogTitle>
              </DialogHeader>
              <div className="py-4">
                <p>Apakah Anda yakin ingin menghapus standar kemiskinan ini?</p>
                <p className="text-sm text-gray-500 mt-2">Tindakan ini tidak dapat dibatalkan.</p>
              </div>
              <div className="flex justify-end space-x-2">
                <Button variant="outline" onClick={cancelDelete}>
                  Batal
                </Button>
                <Button variant="destructive" onClick={confirmDelete}>
                  Hapus
                </Button>
              </div>
            </DialogContent>
          </Dialog>
        </>
      );
    },
  },
];

interface ImportJobsTableProps {
  data: ImportJob[];
  type: string; // 'cibest' or 'baznas'
}

export default function ImportJobsTable({ data }: ImportJobsTableProps) {
  return (
    <div className="w-full h-fit flex flex-col gap-4 overflow-auto bg-white p-6 rounded-lg shadow-md">
      <p className="font-semibold">Riwayat Import Data</p>
      <DataTable columns={importJobColumns} data={data} />
    </div>
  );
}