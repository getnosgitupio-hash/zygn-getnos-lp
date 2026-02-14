import React from "react";
import { motion } from "framer-motion";
import logo from "../assets/logo.svg";
import bg from "../assets/bg.webp";
import ProgressLoad from "./ProgressLoad";

export default function ZygnHero({ isPopupOpen = false, openPopup }) {
  return (
    <section
      className="relative min-h-screen w-full overflow-hidden text-white"
      style={{
        backgroundImage: `url(${bg})`,
        backgroundSize: "cover",
        backgroundPosition: "center",
      }}
    >
      {/* Top trust bar */}
      <div className="bg-red-600 py-2 text-center sm:text-sm text-xs font-medium">
        50+ studios managing ₹5-12 Cr grew faster with Zygn, claim your spot before January ends.
      </div>


      {/* Content */}
      <div className="relative mx-auto flex max-w-full flex-col items-center sm:px-6 px-4 sm:pt-12 pt-7 sm:pb-20 pb-12 text-center">
        
{/* Logo left + Attention center */}
<div className="sm:mb-10 mb-4 grid w-full sm:grid-cols-3 grid-cols-1 items-center">
  
  {/* Left: Logo */}
  <div className="flex justify-center">
    <img src={logo} alt="Zygn" className="w-28 sm:w-28 pb-6 sm:pb-0" />
  </div>

  {/* Center: Attention pill */}
  <motion.div
    initial={{ opacity: 0, y: 10 }}
    animate={{ opacity: 1, y: 0 }}
    transition={{ duration: 0.5 }}
    className="mx-auto inline-flex items-center gap-2 rounded-full bg-black/50 px-4 py-2 text-[10px] sm:text-base font-semibold uppercase tracking-wide"
  >
    <span className="sm:h-6 sm:w-6 h-5 w-5 rounded-full bg-red-500"></span>
    Attention: Interior Design & Design-Build Firms
  </motion.div>

  {/* Right: Empty spacer (keeps center true) */}
  <div />
</div>


<div className="mt-6 text-center px-0 sm:px-0">

  {/* Line 1 */}
  <motion.h1
    initial={{ opacity: 0, y: 40 }}
    animate={{ opacity: 1, y: 0 }}
    transition={{ duration: 0.7 }}
    className="text-[32px] leading-tight font-extrabold sm:text-[28px] md:text-7xl"
  >
    RUN YOUR INTERIOR
  </motion.h1>

  {/* Line 2: DESIGN–BUILD + pill */}
  <div className="mt-2 sm:mt-0 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
    <motion.h1
      initial={{ opacity: 0, y: 40 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ delay: 0.1 }}
      className="text-[30px] leading-tight font-extrabold sm:text-[28px] md:text-7xl"
    >
      <span className="text-red-500">DESIGN-BUILD</span>
    </motion.h1>

    {/* Purple pill */}
    <motion.div
      initial={{ opacity: 0, y: 10 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ delay: 0.2 }}
      className="sm:rounded-full rounded-lg bg-purple-600 sm:px-4 px-2 py-2 text-xl sm:text-sm font-bold text-white text-center"
    >
      REAL-TIME CONTROL
      <span className="block sm:text-[10px] text-[10px] font-normal leading-tight">
        India-First End-to-End Workflow
      </span>
    </motion.div>
  </div>

  {/* Line 3 */}
  <motion.h1
    initial={{ opacity: 0, y: 40 }}
    animate={{ opacity: 1, y: 0 }}
    transition={{ delay: 0.15 }}
    className="mt-2 sm:mt-0 text-[25px] leading-tight font-extrabold sm:text-[28px] md:text-7xl"
  >
    FIRM LIKE A SYSTEM, NOT
  </motion.h1>

 {/* Line 4 */}
<div className="mt-3 sm:mt-0 grid grid-cols-3 sm:flex items-center justify-center gap-2 sm:gap-4">

  {/* Red pill */}
  <div className="sm:rounded-full rounded-lg bg-red-600 sm:px-3 px-0 sm:py-2 py-2 text-sm sm:text-sm font-bold text-center">
    ₹50–400 CR
    <span className="block text-[11px] sm:text-[10px] font-normal leading-tight">
      Project Values Managed
    </span>
  </div>

  <motion.h1
    initial={{ opacity: 0, y: 40 }}
    animate={{ opacity: 1, y: 0 }}
    transition={{ delay: 0.2 }}
    className="text-[22px] sm:text-[28px] md:text-7xl font-extrabold text-center leading-tight"
  >
    A CIRCUS
  </motion.h1>

  {/* Green pill */}
  <div className="sm:rounded-full rounded-lg bg-green-500 sm:px-3 px-0 sm:py-2 py-2 text-sm sm:text-sm font-bold text-center">
    300 USERS
    <span className="block text-[11px] sm:text-[10px] font-normal leading-tight">
      35% Increase in Productivity
    </span>
  </div>

</div>

</div>



 

        {/* Description */}
        <motion.p
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.4 }}
          className="mt-8 max-w-3xl text-sm sm:text-base leading-relaxed text-gray-300"
        >
          Zygn is an all-in-one ERP for interior design-build firms, unifying
          sales, design, procurement, site, HR, and finance. Ditch spreadsheets
          and WhatsApp chaos. Assign leads with full action logs, track follow-ups,
          automate reports, and gain total project control with clear visibility
          and accountability.
        </motion.p>

        {/* CTA */}
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.6 }}
          className="mt-12"
        >
          <button onClick={openPopup} className="rounded-full bg-red-600 sm:px-12 px-2 py-4 text-[12px] sm:text-lg tracking-wide transition hover:bg-red-700">
            BOOK YOUR FREE ZYGN DEMO + WORKFLOW AUDIT
          </button>

          <p className="mt-4 text-[16px] text-gray-300"><span className="text-red-400">Only 6 February slots left</span> | 300 studios already transformed operations.</p>

          <ProgressLoad />
        </motion.div>
      </div>
    </section>
  );
}
