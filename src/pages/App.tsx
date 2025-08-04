import { Route, Routes } from "react-router-dom";
import Index from "./Index";
import NotFound from "./NotFound";
import Contabilidad from "./modules/Contabilidad";
import Facturacion from "./modules/Facturacion";
import Nomina from "./modules/Nomina";
import POS from "./modules/POS";

function App() {
  return (
    <Routes>
      <Route path="/" element={<Index />} />
      <Route path="/contabilidad" element={<Contabilidad />} />
      <Route path="/facturacion" element={<Facturacion />} />
      <Route path="/nomina" element={<Nomina />} />
      <Route path="/pos" element={<POS />} />
      <Route path="*" element={<NotFound />} />
    </Routes>
  );
}

export default App;
