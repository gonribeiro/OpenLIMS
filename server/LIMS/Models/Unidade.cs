using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.ComponentModel.DataAnnotations;

namespace LIMS.Models
{
    public class Unidade
    {
        public int Id { get; set; }
        [Required]
        public string UN { get; set; }
        public DateTime Delete_at { get; set; }
    }
}
