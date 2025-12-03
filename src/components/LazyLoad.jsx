import { useState } from "react";
export function LazyImage({ src, alt }) {
  const [loaded, setLoaded] = useState(false);

  return (
    <div className="w-full h-full relative">
      
      {/* LOADING SKELETON */}
      {!loaded && (
        <div className="absolute inset-0 bg-gray-700 animate-pulse rounded-lg"></div>
      )}

      <img
        src={src}
        alt={alt}
        onLoad={() => setLoaded(true)}
        className={`w-full h-full object-cover transition-opacity duration-500 ${loaded ? "opacity-100" : "opacity-0"
          }`}
      />
    </div>
  );
}
