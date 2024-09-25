'use client'

import { useEffect } from "react";
import styles from "./page.module.css";

export default function Home() {
  useEffect(() => {
    require('bootstrap/dist/js/bootstrap.bundle.js');
   },[])
 
  return (
    <div className={styles.page}>
      <main>
          <h1 className="text-center">Home Page</h1>
      </main>
    </div>
  );
}
