import { Link, useLocation } from "react-router-dom";
import {LazyImage} from "../components/LazyLoad";
export default function SuccessPage() {
  const location = useLocation();
  const { data } = location.state || {};

  // SIMPAN HISTORY SETIAP BERHASIL BAYAR
  
  if (data.status === "error") {
    return (
      <div className="min-h-screen bg-gray-900 text-white p-6 text-center">
        <h1 className="text-3xl font-bold mb-4 text-red-400">Tidak Ada Data</h1>
        <p>Data pesanan tidak ditemukan.</p>
        <Link
          to="/"
          className="bg-blue-600 py-3 rounded-xl font-semibold w-full max-w-sm mx-auto mt-6 block"
        >
          Kembali ke Home
        </Link>
      </div>
    );
  }

  const item = data.transaksi;

  return (
    <div className="min-h-screen bg-gray-900 text-white p-6 text-center">
      <h1 className="text-3xl font-bold mb-4 text-green-400">
        Pembayaran Berhasil!
      </h1>
      <p className="text-gray-300 mb-6">Pesanan Anda sedang diproses.</p>

      <div className="bg-gray-800 p-5 rounded-xl text-left max-w-md mx-auto border border-gray-700">
        <p>
          <strong>ID Transaksi:</strong> {data.transaksi.id}
        </p>
        <p>
          <strong>Game:</strong> {item.items[0].game}
        </p>
        <p>
          <strong>Jumlah top up:</strong> {item.items[0].amount}
        </p>
        <p>
          <strong>Harga:</strong> Rp {item.items[0].price.toLocaleString()}
        </p>
        <p>
          <strong>ID Player:</strong> {item.userId}
        </p>
        <p>
          <strong>Metode:</strong> {item.method}
        </p>
        <p className="text-gray-400 text-sm mt-2">{item.date}</p>
          <div className="flex items-center justify-center">
            <LazyImage src="http://localhost:8000/media/api.qrserver.png" alt="kokekab" className="mx-auto w-1/3" />
          </div>
          
      </div>

      <div className="mt-8 flex flex-col gap-3">
        <Link
          to="/"
          className="bg-blue-600 hover:bg-blue-700 py-3 rounded-xl font-semibold w-full max-w-sm mx-auto transition duration-300"
        >
          Kembali ke Home
        </Link>

        <Link
          to="/history"
          className="bg-gray-700 hover:bg-gray-800 py-3 rounded-xl font-semibold w-full max-w-sm mx-auto transition duration-300"
        >
          Lihat Riwayat Pesanan
        </Link>
      </div>
    </div>
  );
}
