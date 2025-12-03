import { useState } from "react"
import { Button } from "@/components/ui/button"
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog"
import { QUADRANT_COLORS } from "@/lib/constants"
import { Province } from "@/types"

interface ProvinceTableProps {
  provinces: Province[];
}

export function ProvinceTable({ provinces }: ProvinceTableProps) {
  const [showModal, setShowModal] = useState(false)

  const getQuadrantColor = (quadrant: string) => {
    const colors: Record<string, string> = {
      Q1: QUADRANT_COLORS.Q1,
      Q2: QUADRANT_COLORS.Q2,
      Q3: QUADRANT_COLORS.Q3,
      Q4: QUADRANT_COLORS.Q4,
    }
    return colors[quadrant] || "#ccc"
  }

  return (
    <>
      <div className="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div className="flex justify-between items-center mb-4">
          <h2 className="text-xl font-semibold text-gray-800">Tabel Sebaran Responden</h2>
          <Button onClick={() => setShowModal(true)} className="bg-orange-400 hover:bg-orange-500 text-white">
            View More
          </Button>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-orange-400 text-white">
                <th className="px-4 py-3 text-left">No.</th>
                <th className="px-4 py-3 text-left">Provinsi</th>
                <th className="px-4 py-3 text-center">Q1</th>
                <th className="px-4 py-3 text-center">Q2</th>
                <th className="px-4 py-3 text-center">Q3</th>
                <th className="px-4 py-3 text-center">Q4</th>
                <th className="px-4 py-3 text-center">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              {provinces.slice(0, 6).map((province, idx) => (
                <tr key={province.id || idx} className="border-b border-gray-200 hover:bg-gray-50">
                  <td className="px-4 py-3">{idx + 1}</td>
                  <td className="px-4 py-3">{province.name}</td>
                  <td className="px-4 py-3 text-center">{province.Q1}</td>
                  <td className="px-4 py-3 text-center">{province.Q2}</td>
                  <td className="px-4 py-3 text-center">{province.Q3}</td>
                  <td className="px-4 py-3 text-center">{province.Q4}</td>
                  <td className="px-4 py-3 text-center font-semibold">{province.total}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      {/* Modal for detailed province data */}
      <Dialog open={showModal} onOpenChange={setShowModal}>
        <DialogContent className="max-w-4xl max-h-96 overflow-y-auto">
          <DialogHeader>
            <DialogTitle>Detail Sebaran Responden per Provinsi</DialogTitle>
          </DialogHeader>
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="bg-orange-400 text-white">
                  <th className="px-4 py-3 text-left">No.</th>
                  <th className="px-4 py-3 text-left">Provinsi</th>
                  <th className="px-4 py-3 text-center">Q1</th>
                  <th className="px-4 py-3 text-center">Q2</th>
                  <th className="px-4 py-3 text-center">Q3</th>
                  <th className="px-4 py-3 text-center">Q4</th>
                  <th className="px-4 py-3 text-center">Jumlah</th>
                  <th className="px-4 py-3 text-center">Dominan</th>
                </tr>
              </thead>
              <tbody>
                {provinces.map((province, idx) => (
                  <tr key={province.id || idx} className="border-b border-gray-200 hover:bg-gray-50">
                    <td className="px-4 py-3">{idx + 1}</td>
                    <td className="px-4 py-3">{province.name}</td>
                    <td className="px-4 py-3 text-center">{province.Q1}</td>
                    <td className="px-4 py-3 text-center">{province.Q2}</td>
                    <td className="px-4 py-3 text-center">{province.Q3}</td>
                    <td className="px-4 py-3 text-center">{province.Q4}</td>
                    <td className="px-4 py-3 text-center font-semibold">{province.total}</td>
                    <td className="px-4 py-3 text-center">
                      <span
                        className="px-2 py-1 rounded text-white text-xs font-semibold"
                        style={{ backgroundColor: getQuadrantColor(province.dominant) }}
                      >
                        {province.dominant}
                      </span>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </DialogContent>
      </Dialog>
    </>
  )
}
