import React from "react";
import { Box, Typography, Button } from "@mui/material";

const Hero = () => {
  return (
    <Box
      sx={{
        background: "linear-gradient(135deg, #0a1929, #1a2845)",
        color: "white",
        textAlign: "center",
        py: 10,
      }}
    >
      <Typography variant="h3" fontWeight="bold">
        NetWave 5G Internet
      </Typography>
      <Typography variant="h6" sx={{ opacity: 0.8, mb: 3 }}>
        Lidhje pa kufij me shpejtësi të pabesueshme dhe stabilitet që e ndjen në çdo klikim.
      </Typography>
      <Button
        variant="contained"
        color="primary"
        href="#planet5g"
        sx={{ px: 4, py: 1.5, fontWeight: "bold" }}
      >
        Shiko paketat 5G
      </Button>
    </Box>
  );
};

export default Hero;
