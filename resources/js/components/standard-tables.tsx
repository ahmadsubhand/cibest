import { PovertyStandard } from "@/types"

export function StandardTables({ povertyStandards }: { povertyStandards: PovertyStandard[] }) {
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
                <th className="px-4 py-2 text-center">Index Kesejahteraan CIBEST</th>
                <th className="px-4 py-2 text-center">Besaran Nilai CIBEST Model</th>
              </tr>
            </thead>
            <tbody>
              {povertyStandards.map((item, idx) => (
                <tr key={item.id} className="border-b border-gray-200 hover:bg-gray-50">
                  <td className="px-4 py-2">{idx + 1}</td>
                  <td className="px-4 py-2">{item.name}</td>
                  <td className="px-4 py-2 text-center">{item.index_kesejahteraan_cibest !== null ? item.index_kesejahteraan_cibest : "-"}</td>
                  <td className="px-4 py-2 text-center">{item.besaran_nilai_cibest_model !== null ? item.besaran_nilai_cibest_model : "-"}</td>
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
                <th className="px-4 py-2 text-center">Nilai Keluarga</th>
                <th className="px-4 py-2 text-center">Per Tahun</th>
                <th className="px-4 py-2 text-center">Log Natural</th>
              </tr>
            </thead>
            <tbody>
              {povertyStandards.map((item, idx) => (
                <tr key={item.id} className="border-b border-gray-200 hover:bg-gray-50">
                  <td className="px-4 py-2">{idx + 1}</td>
                  <td className="px-4 py-2">{item.name}</td>
                  <td className="px-4 py-2 text-center">{item.nilai_keluarga !== null ? item.nilai_keluarga.toLocaleString() : "-"}</td>
                  <td className="px-4 py-2 text-center">{item.nilai_per_tahun !== null ? item.nilai_per_tahun.toLocaleString() : "-"}</td>
                  <td className="px-4 py-2 text-center">{item.log_natural !== null ? item.log_natural : "-"}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  )
}
