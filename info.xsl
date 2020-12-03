<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <html>
  <body>
    <h2>Faculties who use our system</h2>
    <table class='table table-striped' border="1">
      <tr >
        <th class='thead-dark'>Name</th>
        <th class='thead-dark'>College</th>
      </tr>
      <xsl:for-each select="catalog/faculty">
      <tr>
        <td><xsl:value-of select="title" /></td>
        <td><xsl:value-of select="College" /></td>
      </tr>
      </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>

