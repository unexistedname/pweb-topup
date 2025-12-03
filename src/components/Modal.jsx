import { createPortal } from 'react-dom';

export default function Modal({ children, isOpen, onClose }) {
    if (!isOpen) return null;

    return createPortal(
        <div className="fixed inset-0 bg-black bg-opacity-50">
            <div className="flex items-center justify-center">
                <div className="bg-white rounded-lg p-4">
                    {children}
                    <button className="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" onClick={onClose}>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    );
};