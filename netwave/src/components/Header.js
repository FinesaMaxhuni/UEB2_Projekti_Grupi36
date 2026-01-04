import React from "react";
import { AppBar, Toolbar, Button, Container, Box } from "@mui/material";

function Header() {
  return (
    <AppBar
      position="sticky"
      sx={{
        background: "#0a1929",
        boxShadow: "0 2px 10px rgba(0,0,0,0.3)",
      }}
    >
      <Container>
        <Toolbar sx={{ display: "flex", justifyContent: "space-between" }}>
          {/* Logo */}
          <Box sx={{ display: "flex", alignItems: "center" }}>
            <img
              src="/netwavelogo.png"
              alt="NetWave Logo"
              style={{ width: "140px", height: "auto", cursor: "pointer" }}
              onClick={() => window.scrollTo(0, 0)}
            />
          </Box>

          {/* Navigation */}
          <Box>
            <Button color="inherit" sx={{ textTransform: "none" }}>Mobile</Button>
            <Button color="inherit" sx={{ textTransform: "none" }}>TV</Button>
            <Button color="inherit" sx={{ textTransform: "none" }}>Internet</Button>
            <Button color="inherit" sx={{ textTransform: "none" }}>E-Shop</Button>
          </Box>
        </Toolbar>
      </Container>
    </AppBar>
  );
}

export default Header;

