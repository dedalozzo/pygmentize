<?php

/**
 * @file Pygmentize.php
 * @brief This file contains the Pygmentize class.
 * @details
 * @author Filippo F. Fadda
 */



//! Global namespace for the Pygmentize class.
namespace Pygmentize;


/**
 * @brief Pygments is a wrapper to 'pygmentize', the command line interface provided by Pygments, a python syntax
 * highlighter.
 */
class Pygmentize {

  // Binary name.
  const PIGMENTS_BINARY = "pygmentize";


  /**
   * @brief Formats the provided source code using the specified formatter and style.
   * @param[in] string $source The source code.
   * @param[in] string $language The programming language name of the source code.
   * @param[in] string $encoding The file input and output encodings.
   * @param[in] string $formatter The output will be created using the provided formatter.
   * @param[in] string $style The style used by the formatter.
   * @return string The highlighted source code.
   */
  public static function highlight($source, $language, $encoding = "utf-8", $formatter = "html", $style = "borland") {

    // Try to create a temporary physical file. The function 'proc_open' doesn't allow to use a memory file.
    if ($fd = fopen("php://temp", "r+")) {
      fputs($fd, $source); // We don't need to flush because we call rewind.
      rewind($fd); // Sets the pointer to the beginning of the file stream.

      $dspec = array(
        $fd,
        1 => array('pipe', 'w'), // stdout
        2 => array('pipe', 'w'), // stderr
      );

      if (!empty($language))
        $args = sprintf(" -f %s -l %s -O encoding=%s,style=%s,lineos=1,startinline=true", $formatter, $language, $encoding, $style);
      else
        $args = sprintf(" -f %s -g -O encoding=%s,style=%s,lineos=1", $formatter, $encoding, $style);

      $proc = proc_open(self::PIGMENTS_BINARY.escapeshellcmd($args), $dspec, $pipes);

      if (is_resource($proc)) {
        // Reads the stdout output.
        $output = "";
        while (!feof($pipes[1])) {
          $output .= fgets($pipes[1]);
        }

        // Reads the stderr output.
        $error = "";
        while (!feof($pipes[2])) {
          $error .= fgets($pipes[2]);
        }

        // Free all resources.
        fclose($fd);
        fclose($pipes[1]);
        fclose($pipes[2]);
        $exitCode = proc_close($proc);

        if ($exitCode != 0)
          throw new \RuntimeException($error);

        return $output;
      }
      else
        throw new \RuntimeException("Cannot execute the `pygmentize` command.");
    }
    else
      throw new \RuntimeException("Cannot create the temporary file with the source code.");

  }

}
