import React from "react";
import { Box, Typography } from "@mui/material";

function Footer() {
  return (
    <Box sx={{ background: "#0a1929", color: "white", textAlign: "center", py: 3 }}>
      <Typography variant="body2">
        © 2025 NetWave — Të gjitha të drejtat e rezervuara.
      </Typography>
    </Box>
  );
}

export default Footer;
