import { Button } from '@/components/ui/button';
import { DataTable } from '@/components/table-error/data-table';
import { ImportJob } from '@/types/import-job';
import { ColumnDef } from '@tanstack/react-table';
import { router } from '@inertiajs/react';
import { Clock, Play, CheckCircle, AlertCircle, MoreHorizontal } from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

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

      return (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem
              onClick={() => router.visit(`/import-jobs/${importJob.id}`)}
            >
              Lihat Detail
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
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