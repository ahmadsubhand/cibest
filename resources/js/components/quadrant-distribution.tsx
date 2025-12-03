import { useState } from "react"
import {
  PieChart,
  Pie,
  Cell,
  Legend,
  Tooltip,
  ResponsiveContainer,
  BarChart,
  Bar,
  XAxis,
  YAxis,
  CartesianGrid,
} from "recharts"
import { Button } from "@/components/ui/button"
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog"
import { QUADRANT_COLORS, cibest } from "@/data/cibest-data"

export function QuadrantDistribution() {
  const [showModal, setShowModal] = useState(false)

  const pieData = [
    { name: "Q1 Sejahtera", value: cibest.quadrantDistribution.after.Q1, color: QUADRANT_COLORS.Q1 },
    { name: "Q2 Material", value: cibest.quadrantDistribution.after.Q2, color: QUADRANT_COLORS.Q2 },
    { name: "Q3 Spiritual", value: cibest.quadrantDistribution.after.Q3, color: QUADRANT_COLORS.Q3 },
    { name: "Q4 Absolut", value: cibest.quadrantDistribution.after.Q4, color: QUADRANT_COLORS.Q4 },
  ]

  const barData = [
    {
      name: "Q1",
      Before: cibest.quadrantDistribution.before.Q1,
      After: cibest.quadrantDistribution.after.Q1,
    },
    {
      name: "Q2",
      Before: cibest.quadrantDistribution.before.Q2,
      After: cibest.quadrantDistribution.after.Q2,
    },
    {
      name: "Q3",
      Before: cibest.quadrantDistribution.before.Q3,
      After: cibest.quadrantDistribution.after.Q3,
    },
    {
      name: "Q4",
      Before: cibest.quadrantDistribution.before.Q4,
      After: cibest.quadrantDistribution.after.Q4,
    },
  ]

  return (
    <>
      <div className="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div className="flex justify-between items-center mb-6">
          <h2 className="text-xl font-semibold text-gray-800">Distribusi Kuadran</h2>
          <Button onClick={() => setShowModal(true)} className="bg-teal-500 hover:bg-teal-600 text-white">
            View More
          </Button>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
          {/* Pie Chart */}
          <div className="lg:col-span-1">
            <ResponsiveContainer width="100%" height={300}>
              <PieChart>
                <Pie
                  data={pieData}
                  cx="50%"
                  cy="50%"
                  labelLine={false}
                  label={({ name, value }) => `${name}: ${value}%`}
                  outerRadius={80}
                  fill="#8884d8"
                  dataKey="value"
                >
                  {pieData.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={entry.color} />
                  ))}
                </Pie>
                <Tooltip formatter={(value) => `${value}%`} />
              </PieChart>
            </ResponsiveContainer>
          </div>

          {/* Quadrant Grid */}
          <div className="lg:col-span-2">
            <div className="grid grid-cols-2 gap-4">
              <div className="bg-teal-100 rounded-lg p-4 border-2 border-teal-300">
                <h3 className="font-semibold text-teal-700 mb-2">Quadrant I</h3>
                <p className="text-sm text-teal-600">Sejahtera (+,+)</p>
                <p className="text-2xl font-bold text-teal-700 mt-2">{cibest.quadrantDistribution.after.Q1}%</p>
              </div>
              <div className="bg-pink-100 rounded-lg p-4 border-2 border-pink-300">
                <h3 className="font-semibold text-pink-700 mb-2">Quadrant II</h3>
                <p className="text-sm text-pink-600">Material (-,+)</p>
                <p className="text-2xl font-bold text-pink-700 mt-2">{cibest.quadrantDistribution.after.Q2}%</p>
              </div>
              <div className="bg-green-100 rounded-lg p-4 border-2 border-green-300">
                <h3 className="font-semibold text-green-700 mb-2">Quadrant III</h3>
                <p className="text-sm text-green-600">Spiritual (-,-)</p>
                <p className="text-2xl font-bold text-green-700 mt-2">{cibest.quadrantDistribution.after.Q3}%</p>
              </div>
              <div className="bg-orange-100 rounded-lg p-4 border-2 border-orange-300">
                <h3 className="font-semibold text-orange-700 mb-2">Quadrant IV</h3>
                <p className="text-sm text-orange-600">Absolut (+,-)</p>
                <p className="text-2xl font-bold text-orange-700 mt-2">{cibest.quadrantDistribution.after.Q4}%</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Modal for Before/After Comparison */}
      <Dialog open={showModal} onOpenChange={setShowModal}>
        <DialogContent className="max-w-2xl">
          <DialogHeader>
            <DialogTitle>Distribusi Kuadran - Perbandingan Before & After</DialogTitle>
          </DialogHeader>
          <div className="w-full h-96">
            <ResponsiveContainer width="100%" height="100%">
              <BarChart data={barData}>
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="name" />
                <YAxis />
                <Tooltip />
                <Legend />
                <Bar dataKey="Before" fill="#FFD4A3" />
                <Bar dataKey="After" fill="#20B2AA" />
              </BarChart>
            </ResponsiveContainer>
          </div>
        </DialogContent>
      </Dialog>
    </>
  )
}
