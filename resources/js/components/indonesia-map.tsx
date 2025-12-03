import { useEffect, useRef } from "react"

export function IndonesiaMap() {
  const mapContainer = useRef<HTMLDivElement>(null)
  const mapInstance = useRef<any>(null)

  useEffect(() => {
    if (!mapContainer.current) return

    const link = document.createElement("link")
    link.rel = "stylesheet"
    link.href = "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css"
    document.head.appendChild(link)

    const script = document.createElement("script")
    script.src = "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"
    script.async = true
    script.onload = () => {
      const L = (window as any).L
      if (!L) return

      const map = L.map(mapContainer.current, {
        scrollWheelZoom: false,
        dragging: true,
        touchZoom: true,
        doubleClickZoom: true,
        boxZoom: true,
        keyboard: true,
        zoomControl: true,
      }).setView([-2.5, 118], 5)
      
      mapInstance.current = map

      mapContainer.current?.addEventListener('mouseenter', () => {
        map.scrollWheelZoom.enable()
      })
      
      mapContainer.current?.addEventListener('mouseleave', () => {
        map.scrollWheelZoom.disable()
      })

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "© OpenStreetMap contributors",
        maxZoom: 19,
      }).addTo(map)

      // Load local GeoJSON file exported from QGIS
      const geojsonPath = '/data/prov.geojson'
      console.log("Fetching GeoJSON from:", geojsonPath)
      console.log("Full URL:", window.location.origin + geojsonPath)
      
      fetch(geojsonPath)
        .then(res => {
          console.log("Response status:", res.status, res.statusText)
          console.log("Response URL:", res.url)
          if (!res.ok) {
            throw new Error(`HTTP ${res.status}: Failed to load GeoJSON from ${res.url}`)
          }
          return res.json()
        })
        .then(data => {
          console.log("GeoJSON loaded:", data)
          const geoJsonLayer = L.geoJSON(data, {
            style: (feature: any) => {
              const provinceName = (
                feature.properties.PROVINSI || 
                feature.properties.NAME_1 || 
                feature.properties.WADMPR ||
                feature.properties.name ||
                ""
              ).toLowerCase();
              
              let fillColor = "#fb923c"; // Q4 - Orange (default for Papua and other islands)
              let quadrant = "Q4";
              
              // Q1 - Green: Sumatera and Java
              if (provinceName.includes("sumatera") || 
                  provinceName.includes("sumatra") ||
                  provinceName.includes("aceh") ||
                  provinceName.includes("riau") ||
                  provinceName.includes("jambi") ||
                  provinceName.includes("bengkulu") ||
                  provinceName.includes("lampung") ||
                  provinceName.includes("bangka") ||
                  provinceName.includes("jawa") ||
                  provinceName.includes("java") ||
                  provinceName.includes("jakarta") ||
                  provinceName.includes("banten") ||
                  provinceName.includes("yogyakarta")) {
                fillColor = "#22c55e"; // Green
                quadrant = "Q1";
              }
              
              // Q2 - Pink: Sulawesi
              else if (provinceName.includes("sulawesi") ||
                       provinceName.includes("gorontalo")) {
                fillColor = "#ec4899"; // Pink
                quadrant = "Q2";
              }
              
              // Q3 - Yellow/Amber: Kalimantan
              else if (provinceName.includes("kalimantan") ||
                       provinceName.includes("borneo")) {
                fillColor = "#fbbf24"; // Amber
                quadrant = "Q3";
              }
              
              // Q4 remains orange for Papua and other islands (Maluku, Bali, NTB, NTT, etc.)
              
              return {
                fillColor: fillColor,
                weight: 2,
                opacity: 1,
                color: "white",
                dashArray: '3',
                fillOpacity: 0.7
              }
            },
            onEachFeature: (feature: any, layer: any) => {
              const provinceName = 
                feature.properties.PROVINSI || 
                feature.properties.NAME_1 || 
                feature.properties.WADMPR ||
                feature.properties.name ||
                "Unknown";
              
              const provinceNameLower = provinceName.toLowerCase();
              let quadrant = "Q4 - Absolut";
              let color = "#fb923c";
              
              if (provinceNameLower.includes("sumatera") || provinceNameLower.includes("sumatra") ||
                  provinceNameLower.includes("aceh") || provinceNameLower.includes("riau") ||
                  provinceNameLower.includes("jambi") || provinceNameLower.includes("bengkulu") ||
                  provinceNameLower.includes("lampung") || provinceNameLower.includes("bangka") ||
                  provinceNameLower.includes("jawa") || provinceNameLower.includes("java") ||
                  provinceNameLower.includes("jakarta") || provinceNameLower.includes("banten") ||
                  provinceNameLower.includes("yogyakarta")) {
                quadrant = "Q1 - Sejahtera";
                color = "#22c55e";
              } else if (provinceNameLower.includes("sulawesi") || provinceNameLower.includes("gorontalo")) {
                quadrant = "Q2 - Material";
                color = "#ec4899";
              } else if (provinceNameLower.includes("kalimantan") || provinceNameLower.includes("borneo")) {
                quadrant = "Q3 - Spiritual";
                color = "#fbbf24";
              }
              
              layer.bindPopup(
                `<strong>${provinceName}</strong><br/>` +
                `<span style="color: ${color}">●</span> ${quadrant}`
              )

              layer.on('mouseover', function() {
                this.setStyle({
                  weight: 3,
                  color: '#666',
                  fillOpacity: 0.9,
                  dashArray: ''
                })
              })

              layer.on('mouseout', function() {
                this.setStyle({
                  weight: 2,
                  color: 'white',
                  fillOpacity: 0.7,
                  dashArray: '3'
                })
              })
            }
          }).addTo(map)

          // Fit map to show all provinces
          map.fitBounds(geoJsonLayer.getBounds())
        })
        .catch(err => {
          console.error("Error loading GeoJSON:", err)
          alert(
            "Failed to load map data.\n\n" +
            "Please ensure:\n" +
            "1. File exists at: public/data/prov.geojson\n" +
            "2. The file is valid GeoJSON format\n\n" +
            "Error: " + err.message
          )
        })
    }
    document.body.appendChild(script)

    return () => {
      if (mapInstance.current) {
        mapInstance.current.remove()
        mapInstance.current = null
      }
      document.head.removeChild(link)
      document.body.removeChild(script)
    }
  }, [])

  return (
    <div style={{ 
      width: "100%",
      backgroundColor: "white",
      borderRadius: "8px",
      boxShadow: "0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)",
      overflow: "hidden",
      marginTop: "24px",
      position: "relative",
      zIndex: 1
    }}>
      <div 
        style={{
          backgroundColor: "#f8fafc",
          padding: "20px 24px",
          borderBottom: "1px solid #e2e8f0"
        }}
      >
        <h2 
          style={{
            margin: 0,
            fontSize: "18px",
            fontWeight: "600",
            color: "#1e293b"
          }}
        >
          Peta Sebaran Responden
        </h2>
      </div>
      <div 
        ref={mapContainer} 
        style={{ 
          width: "100%", 
          height: "500px",
          position: "relative"
        }} 
      />
    </div>
  )
}