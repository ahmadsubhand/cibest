import { cibest } from "@/data/cibest-data"

export function StandardTables() {
  return (
    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      {/* Standar Kemiskinan */}
      <div className="bg-white rounded-lg shadow-sm p-6">
        <h3 className="text-lg font-semibold text-gray-800 mb-4">Standar Kemiskinan</h3>
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-teal-500 text-white">
                <th className="px-4 py-2 text-left">No.</th>
                <th className="px-4 py-2 text-left">Standar Kemiskinan</th>
                <th className="px-4 py-2 text-center">Nilai</th>
                <th className="px-4 py-2 text-center">CIBEST</th>
              </tr>
            </thead>
            <tbody>
              {cibest.standardPoverty.map((item, idx) => (
                <tr key={idx} className="border-b border-gray-200 hover:bg-gray-50">
                  <td className="px-4 py-2">{idx + 1}</td>
                  <td className="px-4 py-2">{item.name}</td>
                  <td className="px-4 py-2 text-center">{item.value || "-"}</td>
                  <td className="px-4 py-2 text-center">{item.cibest}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      {/* Indikator Kemiskinan Umum */}
      <div className="bg-white rounded-lg shadow-sm p-6">
        <h3 className="text-lg font-semibold text-gray-800 mb-4">Indikator Kemiskinan Umum</h3>
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-teal-500 text-white">
                <th className="px-4 py-2 text-left">No.</th>
                <th className="px-4 py-2 text-left">Indikator</th>
                <th className="px-4 py-2 text-center">Nilai</th>
                <th className="px-4 py-2 text-center">Keluarga</th>
                <th className="px-4 py-2 text-center">Per Tahun</th>
              </tr>
            </thead>
            <tbody>
              {cibest.generalIndicators.map((item, idx) => (
                <tr key={idx} className="border-b border-gray-200 hover:bg-gray-50">
                  <td className="px-4 py-2">{idx + 1}</td>
                  <td className="px-4 py-2">{item.name}</td>
                  <td className="px-4 py-2 text-center">{item.value.toLocaleString()}</td>
                  <td className="px-4 py-2 text-center">{item.family.toLocaleString()}</td>
                  <td className="px-4 py-2 text-center">{item.annual}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  )
}
